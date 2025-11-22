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
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
            ],
            'item_details' => $this->getItemDetails($order),
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
        foreach ($order->orderItems as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => $item->harga_satuan,
                'quantity' => $item->jumlah,
                'name' => $item->product->nama ?? 'Product',
            ];
        }
        return $items;
    }

    public function handleNotification(array $notification)
    {
        $transaction = $notification['transaction_status'];
        $type = $notification['payment_type'];
        $orderId = $notification['order_id'];
        $fraud = $notification['fraud_status'];

        $order = Order::find($orderId);

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
}