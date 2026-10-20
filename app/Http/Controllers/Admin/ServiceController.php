<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::orderBy('category')->get();

        return view('admin.services.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name'   => 'required|string|max:100',
            'category'       => 'required|in:Kiloan,Satuan,Express',
            'price_per_unit' => 'required|integer|min:0',
            'unit_type'      => 'required|in:Kg,Pcs',
            'description'    => 'nullable|string',
        ]);

        Service::create($validated);


        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditamnbahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:100',
            'category' => 'required|in:Kiloan,Satuan,Express',
            'price_per_unit' => 'required|integer|min:0',
            'unit_type' => 'required|in:Kg, Pcs',
            'description' => 'nullable|string',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhsil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if($service->orderDetail()->exists()) {
            return back()->with('Error', 'Layanan sudah dipakai di transaksi tidak bisa dihapus');
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus');
    }
}
