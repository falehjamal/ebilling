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
        .summary-card .card-body {
            padding: 1.25rem;
            position: relative;
        }
        .summary-card .card-icon {
            position: absolute;
            top: 12px;
            right: 14px;
            font-size: 2rem;
            opacity: .25;
        }
        .summary-card .card-value {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .summary-card .card-label {
            font-size: .8rem;
            opacity: .85;
            margin-bottom: 4px;
        }
        .summary-card .card-footer-link {
            display: block;
            text-align: center;
            padding: 8px;
            color: rgba(255,255,255,.8);
            font-size: .8rem;
            background: rgba(0,0,0,.1);
            text-decoration: none;
            transition: background .15s;
        }
        .summary-card .card-footer-link:hover {
            background: rgba(0,0,0,.2);
            color: #fff;
        }
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

        .birthday-card .avatar-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #28A745;
            font-size: 1.25rem;
        }
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
                    <div class="card-value">782 <small style="font-size: .55em; opacity:.8">| Rp 523jt</small></div>
                    <div class="card-label">Pelanggan Sudah Lunas</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-orange">
                <div class="card-body">
                    <i class="bx bx-error card-icon"></i>
                    <div class="card-value">1,028 <small style="font-size: .55em; opacity:.8">| Rp 412jt</small></div>
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
        {{-- Keuangan --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card summary-card bg-card-blue">
                <div class="card-body">
                    <i class="bx bx-wallet card-icon"></i>
                    <dl class="status-list mb-0">
                        <dt>Pemasukan Bulan Ini | Hari Ini</dt>
                        <dd>Rp 85jt | Rp 4.2jt</dd>
                        <dt>Pengeluaran Bulan Ini</dt>
                        <dd>Rp 12jt</dd>
                        <dt>Balance Bulan Ini</dt>
                        <dd>Rp 73jt</dd>
                    </dl>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>

        {{-- Status Langganan --}}
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

        {{-- Ticket Permintaan Aktivasi --}}
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

        {{-- Status WADM --}}
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

    {{-- ========== ROW 4 — Ulang Tahun & Domain Expired ========== --}}
    <div class="row">
        {{-- Ulang Tahun Pelanggan --}}
        <div class="col-xl-8 col-md-7 mb-4">
            <div class="card birthday-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="bx bx-cake text-primary me-1"></i> Ulang Tahun Pelanggan
                        <span class="badge bg-primary ms-1">Februari 2026 | Rp 4.000.000</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Delvia Muliawaty</h6>
                                    <small class="text-muted">16 Februari 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Dolly Darussalam</h6>
                                    <small class="text-muted">17 Februari 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Satya Midhi Tanto</h6>
                                    <small class="text-muted">18 Februari 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Andi Agus Santul</h6>
                                    <small class="text-muted">24 Februari 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">ATIMIT</h6>
                                    <small class="text-muted">06 Februari 2026</small><br>
                                    <small class="text-muted">e-billing art 4</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle"><i class="bx bx-user"></i></div>
                                <div>
                                    <h6 class="mb-0 text-truncate">Indoegold</h6>
                                    <small class="text-muted">14 Februari 2026</small><br>
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

        {{-- Data Domain Akan Expired --}}
        <div class="col-xl-4 col-md-5 mb-4">
            <div class="card summary-card bg-card-red">
                <div class="card-body text-center py-4">
                    <i class="bx bx-x-circle" style="font-size: 4rem; opacity: .3;"></i>
                    <div class="card-value mt-2">165</div>
                    <div class="card-label">Data Domain Akan Expired</div>
                </div>
                <a href="#" class="card-footer-link">Selengkapnya <i class="bx bx-right-arrow-alt"></i></a>
            </div>
        </div>
    </div>

    {{-- ========== KONTEN SEBELUMNYA ========== --}}
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang di E-Billing!</h5>
                            <p class="mb-4">
                                Kelola tagihan dan pembayaran dengan mudah. Pantau ringkasan keuangan Anda di dashboard ini.
                            </p>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary">Lihat Tagihan</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('template/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="Illustration"
                                data-app-dark-img="{{ asset('template/assets/img/illustrations/man-with-laptop-dark.png') }}"
                                data-app-light-img="{{ asset('template/assets/img/illustrations/man-with-laptop-light.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-6 col-md-12 col-lg-6 mb-4">
                    <div class="card"
                        style="background: linear-gradient(135deg, #28a745, #20c997); border: none; border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-1" style="font-size: 0.8rem;">Total Tagihan</h6>
                            <h3 class="text-white mb-1">Rp 125jt</h3>
                            <small class="text-white opacity-75 fw-semibold"><i class="bx bx-up-arrow-alt"></i> +12%
                                bulan ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-12 col-lg-6 mb-4">
                    <div class="card"
                        style="background: linear-gradient(135deg, #20c997, #218838); border: none; border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-1" style="font-size: 0.8rem;">Sudah Dibayar</h6>
                            <h3 class="text-white text-nowrap mb-1">Rp 98jt</h3>
                            <small class="text-white opacity-75 fw-semibold"><i class="bx bx-up-arrow-alt"></i> 78.4%
                                terbayar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Pendapatan Bulanan</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        2026
                                    </button>
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
                                    <span class="badge bg-label-primary p-2"><i
                                            class="bx bx-dollar text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2026</small>
                                    <h6 class="mb-0">Rp 125jt</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>2025</small>
                                    <h6 class="mb-0">Rp 105jt</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card"
                        style="background: linear-gradient(135deg, #ffc107, #fd7e14); border: none; border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-1" style="font-size: 0.8rem;">Belum Bayar</h6>
                            <h3 class="text-white text-nowrap mb-1">Rp 27jt</h3>
                            <small class="text-white opacity-75 fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                -14.82%</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card"
                        style="background: linear-gradient(135deg, #28A745, #1e7e34); border: none; border-radius: 12px;">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-1" style="font-size: 0.8rem;">Pelanggan</h6>
                            <h3 class="text-white mb-1">1,250</h3>
                            <small class="text-white opacity-75 fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                +28.14%</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Laporan Bulan Ini</h5>
                                        <span class="badge bg-label-warning rounded-pill">Februari 2026</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold"><i
                                                class="bx bx-chevron-up"></i> 68.2%</small>
                                        <h3 class="mb-0">Rp 84jt</h3>
                                    </div>
                                </div>
                                <div id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Tagihan</h5>
                        <small class="text-muted">1,250 Total Tagihan</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"><i
                                class="bx bx-dots-vertical-rounded"></i></button>
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
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="bx bx-check-circle"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Tagihan Lunas</h6>
                                    <small class="text-muted">Pembayaran selesai</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">856</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="bx bx-time-five"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Belum Dibayar</h6>
                                    <small class="text-muted">Menunggu pembayaran</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">312</small>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="bx bx-x-circle"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Jatuh Tempo</h6>
                                    <small class="text-muted">Melewati batas waktu</small>
                                </div>
                                <div class="user-progress">
                                    <small class="fw-semibold">82</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#income-tab">
                                Pemasukan
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab">Pengeluaran</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab">Laba</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="income-tab" role="tabpanel">
                            <div class="d-flex p-4 pt-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}"
                                        alt="wallet" />
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total Saldo</small>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">Rp 45.9jt</h6>
                                        <small class="text-success fw-semibold">
                                            <i class="bx bx-chevron-up"></i>
                                            42.9%
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div id="incomeChart"></div>
                            <div class="d-flex justify-content-center pt-4 gap-2">
                                <div class="flex-shrink-0">
                                    <div id="expensesOfWeek"></div>
                                </div>
                                <div>
                                    <p class="mb-n1 mt-1">Pengeluaran Minggu Ini</p>
                                    <small class="text-muted">Rp 3.9jt lebih rendah dari minggu lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transaksi Terakhir</h5>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" data-bs-toggle="dropdown"><i
                                class="bx bx-dots-vertical-rounded"></i></button>
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
                                <img src="{{ asset('template/assets/img/icons/unicons/paypal.png') }}" alt="User"
                                    class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Transfer Bank</small>
                                    <h6 class="mb-0">PT. Maju Jaya</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-success">+Rp 8.2jt</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}" alt="User"
                                    class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">E-Wallet</small>
                                    <h6 class="mb-0">CV. Berkah Abadi</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-success">+Rp 5.5jt</h6>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('template/assets/img/icons/unicons/cc-warning.png') }}" alt="User"
                                    class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Refund</small>
                                    <h6 class="mb-0">Toko Sejahtera</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0 text-danger">-Rp 1.2jt</h6>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
