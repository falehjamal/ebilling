@extends('layouts.app')

@section('title', 'Data Diskon | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    @php($rows = $diskon ?? collect())

    <div class="card mb-4 overflow-hidden">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 text-white py-3"
            style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-gift me-2"></i>Data Diskon</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('data-diskon.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Data
                </a>
                <button type="button" class="btn btn-primary btn-sm" disabled
                    title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-group me-1"></i> Tambah Diskon Semua Pelanggan
                </button>
                <button type="button" class="btn btn-primary btn-sm" disabled
                    title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-map-pin me-1"></i> Berdasarkan Lokasi
                </button>
                <button type="button" class="btn btn-primary btn-sm" disabled
                    title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-package me-1"></i> Berdasarkan Paket
                </button>
                <button type="button" class="btn btn-primary btn-sm" disabled
                    title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-layer me-1"></i> Berdasarkan Paket & Lokasi
                </button>
                <button type="button" class="btn btn-danger btn-sm" disabled title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-trash me-1"></i> Hapus Diskon Semua Pelanggan
                </button>
                <button type="button" class="btn btn-success btn-sm" disabled title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-export me-1"></i> Export
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tableDataDiskon" class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Nama Lokasi</th>
                            <th>Nama Langganan</th>
                            <th>Harga Paket</th>
                            <th>Keterangan</th>
                            <th>Nama Diskon</th>
                            <th>Metode Diskon</th>
                            <th>Nominal Diskon</th>
                            <th>Harga Setelah Diskon</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $r)
                            @php($hargaInt = preg_replace('/[^\d]/', '', (string) ($r->harga ?? '0')) ?: 0)
                            @php($nominalInt = preg_replace('/[^\d]/', '', (string) ($r->nominal_diskon ?? '0')) ?: 0)
                            @php($hargaSetelah = $r->harga_setelah_diskon ?? max(0, (int) $hargaInt - (int) $nominalInt))
                            <tr>
                                <td>{{ $r->id_diskon }}</td>
                                <td>{{ $r->id_pelanggan ?? '-' }}</td>
                                <td>{{ $r->nama_warga ?? '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit((string) ($r->alamat ?? ''), 60) }}</td>
                                <td>{{ $r->nama_lokasi ?? '-' }}</td>
                                <td>{{ $r->nama_tipe ?? '-' }}</td>
                                <td>Rp {{ number_format((int) $hargaInt, 0, ',', '.') }}</td>
                                <td>{{ \Illuminate\Support\Str::limit((string) ($r->keterangan ?? ''), 40) }}</td>
                                <td>{{ $r->nama_diskon ?? '-' }}</td>
                                <td>{{ $r->metode_diskon ?? '-' }}</td>
                                <td>Rp {{ number_format((int) $nominalInt, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format((int) $hargaSetelah, 0, ',', '.') }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('data-diskon.edit', $r->id_diskon) }}"
                                        class="btn btn-success btn-sm" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form id="form-delete-diskon-{{ $r->id_diskon }}" method="post"
                                        action="{{ route('data-diskon.destroy', $r->id_diskon) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete-diskon"
                                            data-form-id="form-delete-diskon-{{ $r->id_diskon }}"
                                            data-nama="{{ $r->nama_diskon }}" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $.fn.DataTable !== 'undefined') {
                $('#tableDataDiskon').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    pageLength: 10,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                    }
                });
            }

            document.querySelectorAll('.btn-delete-diskon').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var formId = btn.getAttribute('data-form-id');
                    var nama = btn.getAttribute('data-nama') || 'diskon ini';
                    if (typeof Swal === 'undefined') {
                        if (confirm('Hapus ' + nama + '?')) {
                            document.getElementById(formId).submit();
                        }
                        return;
                    }
                    Swal.fire({
                        title: 'Hapus data?',
                        text: 'Diskon: ' + nama,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then(function(result) {
                        if (result.isConfirmed && formId) {
                            document.getElementById(formId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
