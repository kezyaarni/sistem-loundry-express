@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<h2>Tambah Layanan Baru</h2>

<form action="{{ route('admin.services.store') }}" method="POST">
    @csrf
    @include('admin.services._form')
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
