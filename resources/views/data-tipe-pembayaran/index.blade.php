@extends('layouts.app')

@section('title', 'Data Tipe Pembayaran | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    @php($rows = $tipePembayaran ?? collect())

    <div class="card mb-4 overflow-hidden">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 text-white py-3"
            style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-credit-card me-2"></i>Data Tipe Pembayaran</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('data-tipe-pembayaran.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Data
                </a>
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
                <table id="tableDataTipePembayaran" class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tipe</th>
                            <th>Keterangan Tipe</th>
                            <th>Harga</th>
                            <th>Jenis Pembayaran</th>
                            <th>Profile</th>
                            <th>Tampil Halaman Registrasi</th>
                            <th>Lokasi</th>
                            <th>Filter Lokasi</th>
                            <th>Jumlah Pelanggan</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $r)
                            <tr>
                                <td>{{ $r->id_tipe_pembayaran }}</td>
                                <td>{{ $r->nama_tipe ?? '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit((string) ($r->keterangan ?? ''), 80) }}</td>
                                <td>Rp {{ number_format((int) ($r->harga ?? 0), 0, ',', '.') }}</td>
                                <td>{{ $r->jns_tipe_pembayaran ?? '-' }}</td>
                                <td>{{ $r->profile ?? '-' }}</td>
                                <td>{{ $r->registrasi ?? '-' }}</td>
                                <td>{{ $r->nama_lokasi ?? '-' }}</td>
                                <td>{{ $r->filter_lokasi ?? '-' }}</td>
                                <td>{{ number_format((int) ($r->jumlah_pelanggan ?? 0)) }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('data-tipe-pembayaran.edit', $r->id_tipe_pembayaran) }}"
                                        class="btn btn-success btn-sm" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form id="form-delete-tipe-{{ $r->id_tipe_pembayaran }}" method="post"
                                        action="{{ route('data-tipe-pembayaran.destroy', $r->id_tipe_pembayaran) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete-tipe"
                                            data-form-id="form-delete-tipe-{{ $r->id_tipe_pembayaran }}"
                                            data-nama="{{ $r->nama_tipe }}" title="Hapus">
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
                $('#tableDataTipePembayaran').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    pageLength: 10,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                    }
                });
            }

            document.querySelectorAll('.btn-delete-tipe').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var formId = btn.getAttribute('data-form-id');
                    var nama = btn.getAttribute('data-nama') || 'tipe ini';
                    if (typeof Swal === 'undefined') {
                        if (confirm('Hapus ' + nama + '?')) {
                            document.getElementById(formId).submit();
                        }
                        return;
                    }
                    Swal.fire({
                        title: 'Hapus data?',
                        text: 'Tipe: ' + nama,
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
