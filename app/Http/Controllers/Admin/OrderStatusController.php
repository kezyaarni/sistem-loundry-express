<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderStatusController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:Antrean,Dicuci,Selesai'
        ]);

        // Simpan perubahan status ke database
        $order->update([
            'status' => $validated['status']
        ]);
        
        return back()->with('success', 'Status pesanan Loundry-'.$order->id.'diperbarui.');
    }
}

