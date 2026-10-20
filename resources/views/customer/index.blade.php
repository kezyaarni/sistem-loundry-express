@extends('layouts.app')

@section('title', 'Pesan Laundry')

@section('content')
<h2 class="mb-1">Pesan Layanan Laundry</h2>
<p class="text-muted">Pilih layanan, isi perkiraan berat (Kg) atau jumlah (Pcs), lalu kirim pesanan.</p>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Nama Pelanggan</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Nomor WhatsApp</label>
            <input type="text" name="whatsapp_number" class="form-control" placeholder="081234567890" value="{{ old('whatsapp_number') }}" required>
        </div>
    </div>

    @foreach ($services as $category => $items)
        <h5 class="mt-4">{{ $category }}</h5>
        <div class="row">
            @foreach ($items as $service)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">{{ $service->service_name }}</h6>
                            <p class="card-text text-muted small">{{ $service->description }}</p>
                            <p class="fw-bold">
                                Rp {{ number_format($service->price_per_unit, 0, ',', '.') }} / {{ $service->unit_type }}
                            </p>
                            <input type="hidden" name="service_id[]" value="{{ $service->id }}">
                            <label class="form-label">Jumlah ({{ $service->unit_type }})</label>
                            <input type="number" name="quantity[]" class="form-control" value="0" min="0" max="500">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary btn-lg mt-3">Kirim Pesanan</button>
</form>
@endsection
