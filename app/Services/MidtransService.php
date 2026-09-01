<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Order;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Order $order)
    {
        $itemDetails = $this->getItemDetails($order);
        $grossAmount = 0;
        foreach ($itemDetails as $item) {
            $grossAmount += $item['price'] * $item['quantity'];
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => $grossAmount > 0 ? $grossAmount : (int) round($order->total_harga),
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
            ],
            'item_details' => $itemDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Midtrans transaction: ' . $e->getMessage());
        }
    }

    private function getItemDetails(Order $order)
    {
        $items = [];
        $order->loadMissing(['orderItems.product', 'orderItems.variant', 'orderItems.customRequest']);

        foreach ($order->orderItems as $item) {
            $name = 'Produk';
            if ($item->product) {
                $name = $item->product->nama_produk;
                if ($item->variant && $item->variant->size) {
                    $name .= ' (' . $item->variant->size . ')';
                }
            } elseif ($item->customRequest) {
                $name = 'Custom - ' . ($item->customRequest->product_category ?? 'Request');
            }

            // Midtrans requires name max 50 characters
            $name = mb_substr($name, 0, 50);

            $itemId = $item->product_id ? (string) $item->product_id : ('CR-' . ($item->custom_request_id ?? $item->id));

            $items[] = [
                'id' => $itemId,
                'price' => (int) round($item->harga_satuan),
                'quantity' => (int) $item->jumlah,
                'name' => $name,
            ];
        }
        return $items;
    }

    public function handleNotification(array $notification)
    {
        $transaction = $notification['transaction_status'] ?? null;
        $type = $notification['payment_type'] ?? null;
        $orderId = $notification['order_id'] ?? null;
        $fraud = $notification['fraud_status'] ?? null;

        if (!$orderId) {
            return false;
        }

        // Extract actual order ID from Midtrans order_id format: ORDER-{id}-{timestamp}
        $actualOrderId = $this->extractOrderId($orderId);
        $order = Order::find($actualOrderId);

        if (!$order) {
            return false;
        }

        $pembayaran = $order->pembayaran;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['status' => 'challenge']);
                    if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'pending']);
                } else {
                    $order->update(['status' => 'success']);
                    if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'paid', 'tanggal_bayar' => now()]);
                }
            }
        } elseif ($transaction == 'settlement') {
            $order->update(['status' => 'success']);
            if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'paid', 'tanggal_bayar' => now()]);
        } elseif ($transaction == 'pending') {
            $order->update(['status' => 'pending']);
            if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'pending']);
        } elseif ($transaction == 'deny') {
            $order->update(['status' => 'failed']);
            if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'failed']);
        } elseif ($transaction == 'expire') {
            $order->update(['status' => 'expired']);
            if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'failed']);
        } elseif ($transaction == 'cancel') {
            $order->update(['status' => 'cancelled']);
            if ($pembayaran) $pembayaran->update(['status_pembayaran' => 'failed']);
        }

        return true;
    }

    /**
     * Extract actual order ID from Midtrans order_id format
     */
    private function extractOrderId($midtransOrderId)
    {
        // Format: ORDER-{id}-{timestamp}
        if (preg_match('/^ORDER-(\d+)(?:-\d+)?$/', $midtransOrderId, $matches)) {
            return (int) $matches[1];
        }
        
        // Fallback: return as is if format doesn't match
        return $midtransOrderId;
    }
}