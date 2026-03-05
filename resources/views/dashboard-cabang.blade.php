@extends('layouts.app')

@section('title', 'Dashboard Cabang | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    @php
        $cabang = $cabang ?? [];
        $summary = $summary ?? [];
        $tgl1 = $tgl1 ?? now()->startOfMonth()->format('Y-m-d');
        $tgl2 = $tgl2 ?? now()->endOfMonth()->format('Y-m-d');
        $tglbulanini = $tglbulanini ?? now()->translatedFormat('F Y');
        $tglskg = $tglskg ?? now()->startOfMonth()->format('Y-m-d');
        $legacyBaseUrl = $legacyBaseUrl ?? rtrim(config('billing.legacy_base_url'), '/');
        $account = $account ?? billing_user('account');
        $accountEncoded = $account ? ((int) $account + 1991) : 0;
    @endphp

    <h2>Data Cabang {{ $tglbulanini }}</h2>
    <br>

    <form action="{{ route('dashboard-cabang') }}" method="get" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="bulan" class="form-label mb-0">Bulan</label>
            </div>
            <div class="col-auto">
                <input type="month" name="tgl" id="bulan" class="form-control" value="{{ substr($tgl1, 0, 7) }}" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-info">Pilih</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No</th>
                    <th>Nama Cabang</th>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pelanggan Baru</th>
                    <th>Jumlah Pelanggan Free</th>
                    <th>Pelanggan Lunas</th>
                    <th>Pelanggan Belum Lunas</th>
                    <th>Total Pemasukan Bulan Ini</th>
                    <th>Pengeluaran Bulan Ini</th>
                    <th>Balance Bulan Ini</th>
                    <th>Metode Insentif</th>
                    <th>Insentif</th>
                    <th>Total Insentif Bulan Ini</th>
                    <th>Total Estimasi Pemasukan Bulan Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cabang as $no => $c)
                    @php
                        $edit = base64_encode($c->id_lokasi + 1991);
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/?page=data-warga-sto&id_lokasi={{ $edit }}" target="_blank" title="Lihat Data Pelanggan" class="btn btn-success btn-sm">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ $legacyBaseUrl }}/?page=data-pemasukan-sto-bulan-ini-1234&id_lokasi={{ $c->id_lokasi }}&tglskg={{ $tglskg }}" target="_blank" title="Lihat Pemasukan" class="btn btn-success btn-sm">
                                <i class="bx bx-money"></i>
                            </a>
                        </td>
                        <td>{{ $no + 1 }}</td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/?page=dashboard-cabang-detail&id_lokasi={{ $c->id_lokasi }}" target="_blank">{{ $c->nama_lokasi }}</a>
                        </td>
                        <td>{{ number_format($c->jumlahpelanggan) }}</td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/billing/admin/laporan/laporan_daftar_pelanggan_baru2_sto_.php?data_account={{ $accountEncoded }}&id_lokasi={{ $c->id_lokasi }}&tgl_awal={{ $tgl1 }}&tgl_akhir={{ $tgl2 }}" target="_blank">
                                {{ number_format($c->total_pelanggan_baru) }}
                            </a>
                        </td>
                        <td>{{ number_format($c->total_pelanggan_free) }}</td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/billing/admin/warga/data_warga_sudah_bayar_admin11.php?data_account={{ $accountEncoded }}&tglskg={{ $tglskg }}&id_lokasi={{ $c->id_lokasi }}" target="_blank">
                                {{ number_format($c->sudahbayar) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/billing/admin/warga/data_warga_belum_bayar_admin11.php?data_account={{ $accountEncoded }}&id_lokasi={{ $c->id_lokasi }}&tglskg={{ $tglskg }}" target="_blank">
                                {{ number_format($c->belumbayar) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/billing/admin/ipl/data_pemasukan17286.php?data_account={{ $account }}&id_lokasi={{ $c->id_lokasi }}&tgl1={{ $tgl1 }}&tgl2={{ $tgl2 }}" target="_blank">
                                {{ format_idr($c->total_iuran) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/billing/admin/laporan/laporan_daftar_pengeluaran_bulan22.php?data_account={{ $accountEncoded }}&tgl_awal={{ $tgl1 }}&tgl_akhir={{ $tgl2 }}&id_lokasi={{ $c->id_lokasi }}" target="_blank">
                                {{ format_idr($c->jml_pengeluaran) }}
                            </a>
                        </td>
                        <td>{{ format_idr($c->balance) }}</td>
                        <td>{{ $c->metode_insentif }}</td>
                        <td>{{ $c->insentif_sales ?? '-' }}</td>
                        <td>{{ $c->insentif_label }}</td>
                        <td>{{ format_idr($c->total_estimasi) }}</td>
                        <td>
                            <a href="{{ $legacyBaseUrl }}/?page=data-warga-sto&id_lokasi={{ $edit }}" target="_blank" title="Lihat Data Pelanggan" class="btn btn-success btn-sm">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <tbody>
            <tr>
                <th width="20%">Total Pelanggan</th>
                <td>{{ number_format($summary['total_pelanggan'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Total Pelanggan Baru</th>
                <td>{{ number_format($summary['total_pelanggan_baru'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Total Pelanggan Free</th>
                <td>{{ number_format($summary['total_pelanggan_free'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Total Pemasukan Bulan ini</th>
                <td>{{ format_idr($summary['total_pemasukan'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Total Pengeluaran Bulan ini</th>
                <td>{{ format_idr($summary['total_pengeluaran'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Balance Bulan ini</th>
                <td>{{ format_idr($summary['balance'] ?? 0) }}</td>
            </tr>
            <tr>
                <th width="20%">Total Estimasi Pemasukan Bulan ini</th>
                <td><b>{{ format_idr($summary['total_estimasi'] ?? 0) }}</b></td>
            </tr>
        </tbody>
    </table>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $.fn.DataTable !== 'undefined') {
                $('#example1').DataTable({
                    order: [[2, 'asc']],
                    pageLength: 25,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
                    }
                });
            }
        });
    </script>
@endpush
