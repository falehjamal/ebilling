@extends('layouts.app')

@section('title', 'Data Lokasi | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    @php($rows = $lokasi ?? collect())

    <div class="card mb-4 overflow-hidden">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 text-white py-3"
            style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-grid-alt me-2"></i>Data Lokasi</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('data-lokasi.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Data
                </a>
                <button type="button" class="btn btn-primary btn-sm" title="Akan tersedia pada versi berikutnya">
                    <i class="bx bx-spreadsheet me-1"></i> Migrasi Lokasi
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
                <table id="tableDataLokasi" class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat</th>
                            <th>Tlp</th>
                            <th>Metode Insentif</th>
                            <th>Insentif</th>
                            <th>ID Group</th>
                            <th>Jumlah Pelanggan</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $r)
                            <tr>
                                <td>{{ $r->id_lokasi }}</td>
                                <td>{{ $r->nama_lokasi ?? '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit((string) ($r->alamat_lokasi ?? ''), 80) }}</td>
                                <td>{{ $r->tlp_lokasi ?? '-' }}</td>
                                <td>{{ $r->metode_insentif ?: '-' }}</td>
                                <td>
                                    @if ($r->insentif_sales !== null && $r->insentif_sales !== '')
                                        {{ is_numeric($r->insentif_sales) ? number_format((float) $r->insentif_sales, 0, ',', '.') : $r->insentif_sales }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $r->group_wa ?? '-' }}</td>
                                <td>{{ number_format((int) ($r->jumlah_pelanggan ?? 0)) }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('data-lokasi.edit', $r->id_lokasi) }}"
                                        class="btn btn-success btn-sm" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form id="form-delete-lokasi-{{ $r->id_lokasi }}" method="post"
                                        action="{{ route('data-lokasi.destroy', $r->id_lokasi) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete-lokasi"
                                            data-form-id="form-delete-lokasi-{{ $r->id_lokasi }}"
                                            data-nama="{{ $r->nama_lokasi }}" title="Hapus">
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
                $('#tableDataLokasi').DataTable({
                    order: [
                        [0, 'asc']
                    ],
                    pageLength: 10,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                    }
                });
            }

            document.querySelectorAll('.btn-delete-lokasi').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var formId = btn.getAttribute('data-form-id');
                    var nama = btn.getAttribute('data-nama') || 'lokasi ini';
                    if (typeof Swal === 'undefined') {
                        if (confirm('Hapus ' + nama + '?')) {
                            document.getElementById(formId).submit();
                        }
                        return;
                    }
                    Swal.fire({
                        title: 'Hapus data?',
                        text: 'Lokasi: ' + nama,
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
