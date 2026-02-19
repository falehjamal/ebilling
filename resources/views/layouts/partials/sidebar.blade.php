<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="display: flex; flex-direction: column; align-items: center; padding: 1rem .75rem .5rem; min-height: auto; height: auto; overflow: visible;">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="flex-grow-1"></div>
            <a href="{{ route('dashboard') }}" class="app-brand-link" style="justify-content: center;">
                <img src="{{ asset('img/ebilling.png') }}" alt="Logo" style="max-height: 55px; width: auto;">
            </a>
            <div class="flex-grow-1 d-flex justify-content-end">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>
        </div>
        <span style="display: block; text-align: center; font-size: .65rem; color: #a1acb8; line-height: 1.3; letter-spacing: .3px; margin-top: 4px;">PT. Altech Sistem Indonesia</span>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item{{ request()->routeIs('dashboard') ? ' active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaksi</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>Tagihan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link"><div>Buat Tagihan</div></a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link"><div>Daftar Tagihan</div></a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div>Pembayaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link"><div>Input Pembayaran</div></a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link"><div>Riwayat Pembayaran</div></a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div>Laporan Keuangan</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-pie-chart-alt"></i>
                <div>Rekap Tagihan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Pelanggan</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Kategori Tagihan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengaturan</span>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Manajemen User</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Pengaturan Aplikasi</div>
            </a>
        </li>
    </ul>
</aside>
