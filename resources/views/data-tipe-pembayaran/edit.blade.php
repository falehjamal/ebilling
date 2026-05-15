@extends('layouts.app')

@section('title', 'Edit Data Tipe Pembayaran | ' . config('app.name', 'E-Billing'))

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('data-tipe-pembayaran.index') }}">Data Tipe Pembayaran</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-edit me-2"></i>Edit Data Tipe Pembayaran</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('data-tipe-pembayaran.update', $tipePembayaran->id_tipe_pembayaran) }}">
                @csrf
                @method('put')
                @include('data-tipe-pembayaran._form', [
                    'mode' => 'edit',
                    'tipePembayaran' => $tipePembayaran,
                    'lokasiOptions' => $lokasiOptions,
                ])
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('data-tipe-pembayaran.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
