<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Http\Request;

class CustomRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'nullable|exists:products,id',
            'foto_request' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_referensi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'keterangan' => 'required|string',
            'harga_estimasi' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_request')) {
            $data['foto_request'] = $request->file('foto_request')->store('custom-requests', 'public');
        }

        if ($request->hasFile('foto_referensi')) {
            $data['foto_referensi'] = $request->file('foto_referensi')->store('custom-requests', 'public');
        }

        $customRequest = CustomRequest::create($data);

        return redirect()->back()->with('success', 'Custom request berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomRequest $customRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomRequest $customRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomRequest $customRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomRequest $customRequest)
    {
        //
    }
}
