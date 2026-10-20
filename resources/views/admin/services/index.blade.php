@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Kelola Layanan dan Tarif</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-success">+ Tambah Layanan</a>
</div>

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>Nama</th><th>Kategori</th><th>Tarif</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @foreach ($service as $service)
            <tr>
                <td>{{ $service->service_name }}</td>
                <td>{{ $service->category }}</td>
                <td>Rp {{ number_format($service->price_per_unit, 0, ',', '.') }} / {{ $service->unit_type }}</td>
                <td>
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
