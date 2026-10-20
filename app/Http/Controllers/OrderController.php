<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('category')->get()->groupBy('category');

        return view('customer.index', compact('services'));
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
            'customer_name' => 'required|string|max:100',
            'whatsapp_number' => ['required', 'regex:/^08[0-9]{8,12}$/'],
            'service_id' => 'required|array',
            'service_id' => 'exists:services,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0|max:500',
        ]);

        //ambil item yang jumlahnya lebih daari 0

        $items = [];
        foreach ($request->service_id as $index => $serviceId){
            $qty = (int) ($request->quantity[$index] ?? 0);

            if ($qty > 0) {
                $items[] =['service_id' => $serviceId, 'quantity' => $qty];
            }
        }

            if (empty($items)) {
                return back()->withInput()->with('error', 'Pilih minimal satu laynan.');
            }

            //transaction order + semua detail disimpen or batal semua
            $order = DB::transaction(function () use ($request, $items) {
                $order = Order::create([
                    'customer_name' => $request->customer_name,
                    'whatsapp_number' => $request->whatsapp_number,
                    'total_price' => 0,
                    'status' => 'Antrean',
                ]);

                $totalPrice = 0;

                foreach ($items as $item) {
                    // ngambil harga dari database, bukan dari input pelanggan
                    $service = Service::findOrFail($item['service_id']);
                    $subtotal = $service->price_per_unit * $item['quantity'];
                    $totalPrice += $subtotal;

                    $order->orderDetails()->create([
                        'service_id' => $service->id,
                        'qty_or_weight' => $item['quantity'],
                        'subtotal' => $subtotal,
                    ]);
                }

                    $order->update(['total_price' => $totalPrice]);

                    return $order;

            });

            return redirect()->route('home')->with('success', 'Pesanan Laundry-'.$order->id. 'berhasil dikirim. Total: Rp '.number_format($order->total_price, 0, ',', '.')

            );
        }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
