@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2>Dashboard Admin</h2>
<p>Pesanan berstatus <strong>Antrean</strong>: {{ $totalAntrean }}</p>

<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white align-middle">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>WhatsApp</th>
                <th>Layanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>LDR-{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        <a href="https://wa.me/62{{ substr($order->whatsapp_number, 1) }}" target="_blank" rel="noopener">
                            {{ $order->whatsapp_number }}
                        </a>
                    </td>
                    <td>
                        @foreach ($order->orderDetails as $detail)
                            {{ $detail->service->service_name }} x{{ $detail->qty_or_weight }} {{ $detail->service->unit_type }}<br>
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-flex gap-1">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select form-select-sm">
                                @foreach (['Antrean', 'Dicuci', 'Selesai'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
