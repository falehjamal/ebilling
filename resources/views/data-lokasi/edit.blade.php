@extends('layouts.app')

@section('title', 'Edit Data Lokasi | ' . config('app.name', 'E-Billing'))

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('data-lokasi.index') }}">Data Lokasi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-edit me-2"></i>Edit Data Lokasi</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('data-lokasi.update', $lokasi->id_lokasi) }}">
                @csrf
                @method('put')
                @include('data-lokasi._form', ['lokasi' => $lokasi])
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('data-lokasi.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
