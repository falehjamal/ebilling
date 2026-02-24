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
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard Cabang</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard Sales</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard Mitra</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard Grafik</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard PPOB</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard Voucher</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map-alt"></i>
                <div>Dashboard Mapping</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Income Summary <span class="text-danger ms-1" style="font-size: 0.7rem; font-weight: bold;">New</span></div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Dashboard e-Kasirmu</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Kelola Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Diskon</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Deposit Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Pelanggan Corporate</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Kartu Member</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Account</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Request Custom</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data IP Remote</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Menu</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Cek Transaksi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Mitra</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Update Aplikasi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data URL WA</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data WA Bot</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Custom Domain</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Upload Data Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Aplikasi Map</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Lokasi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Perusahaan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Tipe Pembayaran</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Notifikasi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Mail Server</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Routes</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Geniaecs</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>OLT ZTE (New)</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Tunnel</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Antena</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Installasi ODP ODC OLT</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Tiang</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Inventaris Perangkat</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Installasi Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Rekening</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Pekerjaan Harian</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Kelola Data Corporate</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Dashboard Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Gaji Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Absensi Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Cuti Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Tunjangan Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Pemotongan Karyawan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Piutang Karyawan</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Poin Pelanggan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Poin Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengaturan Poin</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengaturan Hadiah Poin</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengajuan Penukaran Poin</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Management Mikrotik</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Monitoring</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Session User PPPOE</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data User Static</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data User Static Tree</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data User PPPOE</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data User Hotspot</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Session User Hotspot</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Ticket</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Ticket Pelanggan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Ticket General</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div>Voucher</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Voucher</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Transaksi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran Langganan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Validasi Transaksi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Mutasi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran Umum</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Setor Tunai</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Tagihan Manual</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pemasukan Lain Lain</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengeluaran</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>PO | Penawaran Harga</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Akun</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengumuman</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Status Langganan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data WA</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-tachometer"></i>
                <div>Finance & Accounting</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Dashboard</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Cash & Bank</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Contact</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Daftar Akun</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Data Balance</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Petty Cash</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Reimbursement</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Payment Request</div></a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item"><a href="#" class="menu-link"><div>Pelanggan Baru</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>BHP USO Fee ISP</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Laporan Faktur</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Ringkasan Pembayaran</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Laba Rugi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Ticket</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran Sales</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran Sales Bulanan</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pembayaran Lokasi</div></a></li>
                <li class="menu-item"><a href="#" class="menu-link"><div>Pengeluaran Tahunan</div></a></li>
            </ul>
        </li>
    </ul>
</aside>
