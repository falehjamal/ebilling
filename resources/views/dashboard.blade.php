@extends('layouts.app')

@section('title', 'Dashboard | ' . config('app.name', 'E-Billing'))

@push('styles')
    <style>
        .summary-card {
            border: none;
            border-radius: 12px;
            color: #fff;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            overflow: hidden;
        }
        .summary-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,.15);
        }
        .summary-card .card-body { padding: 1.25rem; position: relative; }
        .summary-card .card-icon { position: absolute; top: 12px; right: 14px; font-size: 2rem; opacity: .25; }
        .summary-card .card-value { font-size: 1.75rem; font-weight: 700; line-height: 1.2; }
        .summary-card .card-label { font-size: .8rem; opacity: .85; margin-bottom: 4px; }
        .summary-card .card-footer-link {
            display: block; text-align: center; padding: 8px;
            color: rgba(255,255,255,.8); font-size: .8rem;
            background: rgba(0,0,0,.1); text-decoration: none; transition: background .15s;
        }
        .summary-card .card-footer-link:hover { background: rgba(0,0,0,.2); color: #fff; }

        .bg-card-blue    { background: linear-gradient(135deg, #28A745, #1e7e34); }
        .bg-card-green   { background: linear-gradient(135deg, #28a745, #1e7e34); }
        .bg-card-orange  { background: linear-gradient(135deg, #f57c00, #e65100); }
        .bg-card-red     { background: linear-gradient(135deg, #e53935, #c62828); }
        .bg-card-teal    { background: linear-gradient(135deg, #00897B, #00695C); }
        .bg-card-yellow  { background: linear-gradient(135deg, #FDD835, #F9A825); }
        .bg-card-purple  { background: linear-gradient(135deg, #34ce57, #28A745); }
        .bg-card-indigo  { background: linear-gradient(135deg, #20c997, #218838); }

        .status-list dt { font-size: .85rem; opacity: .9; }
        .status-list dd { font-size: 1.1rem; font-weight: 600; margin-bottom: .35rem; }

        .new-customer-card .customer-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 8px;
            transition: background .15s;
        }
        .new-customer-card .customer-item:hover { background: rgba(40,167,69,.05); }
        .new-customer-card .avatar-circle {
            width: 42px; height: 42px; min-width: 42px; border-radius: 50%;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            display: flex; align-items: center; justify-content: center;
            color: #28A745; font-size: 1.1rem;
        }
        .new-customer-card .customer-info h6 {
            font-size: .85rem; margin-bottom: 2px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 140px;
        }
        @media (max-width: 575.98px) {
            .new-customer-card .customer-item {
                flex-direction: column;
                text-align: center;
                gap: 6px;
                padding: 12px 6px;
            }
            .new-customer-card .customer-info h6 {
                max-width: 100%;
                white-space: normal;
                font-size: .8rem;
            }
            .new-customer-card .avatar-circle {
                width: 38px; height: 38px; min-width: 38px; font-size: 1rem;
            }
        }

        .money-wrap { display: inline-flex; align-items: center; gap: 4px; }
        .money-wrap .money-toggle {
            cursor: pointer; opacity: .6; transition: opacity .15s;
            font-size: .75em; vertical-align: middle; border: none;
            background: none; padding: 0; color: inherit; line-height: 1;
        }
        .money-wrap .money-toggle:hover { opacity: 1; }
        .summary-card .money-wrap .money-toggle { color: rgba(255,255,255,.7); }
        .summary-card .money-wrap .money-toggle:hover { color: #fff; }
    </style>
@endpush

@section('content')

    {{-- ========== ROW 1 — Pelanggan & Tagihan ========== --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-blue">
                <div class="card-body">
                    <i class="bx bx-group card-icon"></i>
                    <div class="card-value">1,823</div>
                    <div class="card-label">Data Pelanggan</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-green">
                <div class="card-body">
                    <i class="bx bx-check-shield card-icon"></i>
                    <div class="card-value">782 <small style="font-size: .55em; opacity:.8">| <span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 523jt"></i></span></small></div>
                    <div class="card-label">Pelanggan Sudah Lunas</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-orange">
                <div class="card-body">
                    <i class="bx bx-error card-icon"></i>
                    <div class="card-value">1,028 <small style="font-size: .55em; opacity:.8">| <span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 412jt"></i></span></small></div>
                    <div class="card-label">Pelanggan Belum Lunas</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-green">
                <div class="card-body">
                    <i class="bx bx-support card-icon"></i>
                    <div class="card-value">1,823</div>
                    <div class="card-label">Buat Ticket Pelanggan</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>

    {{-- ========== ROW 2 — Ticket ========== --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-blue">
                <div class="card-body">
                    <i class="bx bx-check-circle card-icon"></i>
                    <div class="card-value">13</div>
                    <div class="card-label">Ticket Pelanggan Closed</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-green">
                <div class="card-body">
                    <i class="bx bx-envelope-open card-icon"></i>
                    <div class="card-value">114</div>
                    <div class="card-label">Ticket Open</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-orange">
                <div class="card-body">
                    <i class="bx bx-time-five card-icon"></i>
                    <div class="card-value">3</div>
                    <div class="card-label">Ticket Pending</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-red">
                <div class="card-body">
                    <i class="bx bx-wrench card-icon"></i>
                    <div class="card-value">6</div>
                    <div class="card-label">Ticket Dalam Penanganan</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>

    {{-- ========== ROW 3 — Keuangan, Status, Tiket Aktivasi, WADM ========== --}}
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-blue">
                <div class="card-body">
                    <i class="bx bx-wallet card-icon"></i>
                    <dl class="status-list mb-0">
                        <dt>Pemasukan Bulan Ini | Hari Ini</dt>
                        <dd><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 85jt"></i></span> | <span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 4.2jt"></i></span></dd>
                        <dt>Pengeluaran Bulan Ini</dt>
                        <dd><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 12jt"></i></span></dd>
                        <dt>Balance Bulan Ini</dt>
                        <dd><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 73jt"></i></span></dd>
                    </dl>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-green">
                <div class="card-body">
                    <i class="bx bx-bar-chart card-icon"></i>
                    <dl class="status-list mb-0">
                        <dt>Status Langganan</dt>
                        <dd>1,823</dd>
                        <dt>Status On</dt>
                        <dd>1,150</dd>
                        <dt>Status Off</dt>
                        <dd>673</dd>
                    </dl>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-yellow" style="color: #333;">
                <div class="card-body">
                    <i class="bx bx-key card-icon" style="color: #333;"></i>
                    <div class="card-value" style="color: #333;">0</div>
                    <div class="card-label" style="color: #555;">Ticket Permintaan Aktivasi</div>
                </div>
                <a href="#" class="card-footer-link" style="color: rgba(0,0,0,.6);">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-red">
                <div class="card-body">
                    <i class="bx bx-broadcast card-icon"></i>
                    <div class="card-value" style="font-size: 1.2rem;">Beta Connected</div>
                    <div class="card-label">Status WADM</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>

    {{-- ========== ROW 4 — Pelanggan Baru & Laporan ========== --}}
    <div class="row">
        {{-- Pelanggan Baru --}}
        <div class="col-12 col-lg-8 mb-4">
            <div class="card new-customer-card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-user-plus text-primary me-1"></i> Pelanggan Baru
                        <span class="badge bg-primary ms-1">Februari 2026</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>Delvia Muliawaty</h6>
                                    <small class="text-muted">16 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>Dolly Darussalam</h6>
                                    <small class="text-muted">17 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>Satya Midhi Tanto</h6>
                                    <small class="text-muted">18 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>Andi Agus Santul</h6>
                                    <small class="text-muted">24 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>ATIMIT</h6>
                                    <small class="text-muted">06 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-4 col-6">
                            <div class="customer-item">
                                <div class="avatar-circle"><i class="bx bx-user-plus"></i></div>
                                <div class="customer-info">
                                    <h6>Indoegold</h6>
                                    <small class="text-muted">14 Feb 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="text-primary fw-semibold">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Laporan Bulan Ini --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">Laporan Bulan Ini</h5>
                                <span class="badge bg-label-warning rounded-pill">Februari 2026</span>
                            </div>
                            <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                                <h3 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 84jt"></i></span></h3>
                            </div>
                        </div>
                        <div id="profileReportChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== ROW 5 — Pendapatan Bulanan + Statistik ========== --}}
    <div class="row">
        <div class="col-12 col-lg-8 mb-4">
            <div class="card h-100">
                <div class="row row-bordered g-0 h-100">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Pendapatan Bulanan</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">2026</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0);">2025</a>
                                        <a class="dropdown-item" href="javascript:void(0);">2024</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">78% Terbayar</div>
                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2026</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 125jt"></i></span></h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2025</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 105jt"></i></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Tagihan --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Tagihan</h5>
                        <small class="text-muted">1,250 Total Tagihan</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">856</h2>
                            <span>Tagihan Lunas</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                    </div>
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-check-circle"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Tagihan Lunas</h6>
                                    <small class="text-muted">Pembayaran selesai</small>
                                </div>
                                <div class="user-progress"><small class="fw-semibold">856</small></div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time-five"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Belum Dibayar</h6>
                                    <small class="text-muted">Menunggu pembayaran</small>
                                </div>
                                <div class="user-progress"><small class="fw-semibold">312</small></div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-x-circle"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Jatuh Tempo</h6>
                                    <small class="text-muted">Melewati batas waktu</small>
                                </div>
                                <div class="user-progress"><small class="fw-semibold">82</small></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ========== ROW 6 — Pemasukan/Pengeluaran (Tab) + Transaksi Terakhir ========== --}}
    <div class="row">
        <div class="col-md-6 col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-pemasukan">
                                <i class="bx bx-trending-up me-1"></i> Pemasukan
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab-pengeluaran">
                                <i class="bx bx-trending-down me-1"></i> Pengeluaran
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{-- Tab Pemasukan --}}
                        <div class="tab-pane fade show active" id="tab-pemasukan" role="tabpanel">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-trending-up"></i></span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total Pemasukan Bulan Ini</small>
                                    <h4 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 85jt"></i></span></h4>
                                </div>
                            </div>
                            <div id="pemasukanChart"></div>
                            <div class="row mt-3 g-3">
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Hari Ini</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 4.2jt"></i></span></h6>
                                </div>
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Minggu Ini</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 21jt"></i></span></h6>
                                </div>
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Bulan Lalu</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 78jt"></i></span></h6>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Pengeluaran --}}
                        <div class="tab-pane fade" id="tab-pengeluaran" role="tabpanel">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-trending-down"></i></span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total Pengeluaran Bulan Ini</small>
                                    <h4 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 12jt"></i></span></h4>
                                </div>
                            </div>
                            <div id="pengeluaranChart"></div>
                            <div class="row mt-3 g-3">
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Hari Ini</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 850rb"></i></span></h6>
                                </div>
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Minggu Ini</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 3.2jt"></i></span></h6>
                                </div>
                                <div class="col-4 text-center">
                                    <small class="text-muted d-block">Bulan Lalu</small>
                                    <h6 class="mb-0"><span class="money-wrap"><span class="money-text">Rp ***</span><i class="bx bx-hide money-toggle" data-real="Rp 9.5jt"></i></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaksi Terakhir --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transaksi Terakhir</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:void(0);">28 Hari Terakhir</a>
                            <a class="dropdown-item" href="javascript:void(0);">Bulan Lalu</a>
                            <a class="dropdown-item" href="javascript:void(0);">Tahun Ini</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('template/assets/img/icons/unicons/paypal.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Transfer Bank</small>
                                    <h6 class="mb-0">PT. Maju Jaya</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-success"><span class="money-wrap"><span class="money-text">+Rp ***</span><i class="bx bx-hide money-toggle" data-real="+Rp 8.2jt"></i></span></h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">E-Wallet</small>
                                    <h6 class="mb-0">CV. Berkah Abadi</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-success"><span class="money-wrap"><span class="money-text">+Rp ***</span><i class="bx bx-hide money-toggle" data-real="+Rp 5.5jt"></i></span></h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('template/assets/img/icons/unicons/cc-warning.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Refund</small>
                                    <h6 class="mb-0">Toko Sejahtera</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-danger"><span class="money-wrap"><span class="money-text">-Rp ***</span><i class="bx bx-hide money-toggle" data-real="-Rp 1.2jt"></i></span></h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    document.querySelectorAll('.money-toggle').forEach(function (icon) {
        icon.addEventListener('click', function () {
            var wrap = this.closest('.money-wrap');
            var text = wrap.querySelector('.money-text');
            var real = this.dataset.real;
            var hidden = text.dataset.hidden || text.textContent;

            if (!text.dataset.hidden) {
                text.dataset.hidden = text.textContent;
            }

            if (text.textContent === hidden || text.textContent.indexOf('***') !== -1) {
                text.textContent = real;
                this.classList.remove('bx-hide');
                this.classList.add('bx-show');
            } else {
                text.textContent = hidden;
                this.classList.remove('bx-show');
                this.classList.add('bx-hide');
            }
        });
    });

    // Pemasukan Chart
    const pemasukanEl = document.querySelector('#pemasukanChart');
    if (pemasukanEl) {
        new ApexCharts(pemasukanEl, {
            series: [{ name: 'Pemasukan', data: [31, 40, 28, 51, 42, 65, 55, 48, 38, 52, 60, 45] }],
            chart: { height: 220, type: 'area', toolbar: { show: false }, parentHeightOffset: 0 },
            colors: [config.colors.primary],
            dataLabels: { enabled: false },
            stroke: { width: 2, curve: 'smooth' },
            fill: {
                type: 'gradient',
                gradient: { shadeIntensity: 0.6, opacityFrom: 0.5, opacityTo: 0.1, stops: [0, 95, 100] }
            },
            grid: { borderColor: config.colors.borderColor, strokeDashArray: 3, padding: { top: -15, bottom: -5, left: 0, right: 8 } },
            xaxis: {
                categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
                axisBorder: { show: false }, axisTicks: { show: false },
                labels: { style: { fontSize: '12px', colors: config.colors.axisColor } }
            },
            yaxis: { labels: { show: false } },
            tooltip: { y: { formatter: function(v) { return 'Rp ' + v + 'jt'; } } }
        }).render();
    }

    // Pengeluaran Chart
    const pengeluaranEl = document.querySelector('#pengeluaranChart');
    if (pengeluaranEl) {
        new ApexCharts(pengeluaranEl, {
            series: [{ name: 'Pengeluaran', data: [15, 22, 18, 30, 25, 20, 28, 17, 24, 19, 23, 16] }],
            chart: { height: 220, type: 'bar', toolbar: { show: false }, parentHeightOffset: 0 },
            colors: [config.colors.danger],
            plotOptions: { bar: { borderRadius: 6, columnWidth: '45%' } },
            dataLabels: { enabled: false },
            grid: { borderColor: config.colors.borderColor, strokeDashArray: 3, padding: { top: -15, bottom: -5, left: 0, right: 8 } },
            xaxis: {
                categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
                axisBorder: { show: false }, axisTicks: { show: false },
                labels: { style: { fontSize: '12px', colors: config.colors.axisColor } }
            },
            yaxis: { labels: { show: false } },
            tooltip: { y: { formatter: function(v) { return 'Rp ' + v + 'jt'; } } }
        }).render();
    }
})();
</script>
@endpush
