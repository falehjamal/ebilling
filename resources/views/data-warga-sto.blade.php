@extends('layouts.app')

@section('title', 'Data Pelanggan | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    @php
        $pelanggan = $pelanggan ?? collect([]);
        $lokasi = $lokasi ?? null;
        $namaLokasi = $lokasi->nama_lokasi ?? 'Lokasi #' . ($id_lokasi ?? '');
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Pelanggan</h2>
            <p class="text-muted mb-0">{{ $namaLokasi }}</p>
        </div>
        <a href="{{ route('dashboard-cabang') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i> Kembali ke Dashboard Cabang
        </a>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablePelanggan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Blok / No Rumah</th>
                            <th>Tlp</th>
                            <th>Nama Langganan</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Status Langganan</th>
                            <th>Tanggal Registrasi</th>
                            <th>Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $no => $p)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $p->id_pelanggan ?? '-' }}</td>
                                <td>{{ $p->nama_warga ?? '-' }}</td>
                                <td>{{ $p->alamat ?? '-' }}</td>
                                <td>{{ trim(($p->blok ?? '') . ' / ' . ($p->no_rumah ?? ''), ' /') ?: '-' }}</td>
                                <td>{{ $p->tlp_user ?? $p->tlp ?? '-' }}</td>
                                <td>{{ $p->nama_tipe ?? '-' }}</td>
                                <td>{{ $p->keterangan ?? '-' }}</td>
                                <td>{{ isset($p->harga) ? format_idr($p->harga) : '-' }}</td>
                                <td>{{ $p->status_langganan ?? '-' }}</td>
                                <td>{{ $p->tgl_registrasi ? \Carbon\Carbon::parse($p->tgl_registrasi)->translatedFormat('d M Y') : '-' }}</td>
                                <td>
                                    @if ($p->tgl_jatuh_tempo ?? null)
                                        {{ str_contains((string) $p->tgl_jatuh_tempo, '-') ? \Carbon\Carbon::parse($p->tgl_jatuh_tempo)->translatedFormat('d M Y') : $p->tgl_jatuh_tempo }}
                                    @else
                                        -
                                    @endif
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
                $('#tablePelanggan').DataTable({
                    order: [[1, 'asc']],
                    pageLength: 25,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                    }
                });
            }
        });
    </script>
@endpush
