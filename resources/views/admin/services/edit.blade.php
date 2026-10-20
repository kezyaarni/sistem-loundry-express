@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<h2>Edit Layanan</h2>

<form action="{{ route('admin.services.update', $service) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.services._form')
    <button class="btn btn-primary">Perbarui</button>
</form>
@endsection
