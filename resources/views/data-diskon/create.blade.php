@extends('layouts.app')

@section('title', 'Tambah Data Diskon | ' . config('app.name', 'E-Billing'))

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
@endpush

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('data-diskon.index') }}">Data Diskon</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>

    <div class="card mb-4">
        <div class="card-header text-white" style="background-color: #28A745;">
            <h5 class="mb-0 text-white"><i class="bx bx-plus me-2"></i>Tambah Data Diskon</h5>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="post" action="{{ route('data-diskon.store') }}">
                @csrf
                @include('data-diskon._form', [
                    'mode' => 'create',
                    'diskon' => null,
                    'pelangganOptions' => $pelangganOptions,
                ])
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('data-diskon.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        (function() {
            const METODE_PRESENTASE = @json(\App\Enums\MetodeDiskon::Presentase->value);
            const METODE_NOMINAL = @json(\App\Enums\MetodeDiskon::Nominal->value);

            function parseMoneyInt(val) {
                if (val == null || val === '') {
                    return 0;
                }
                var s = String(val).replace(/[^\d\-]/g, '');
                if (s === '' || s === '-') {
                    return 0;
                }
                var n = parseInt(s, 10);
                return isNaN(n) ? 0 : n;
            }

            function formatIdr(n) {
                return 'Rp ' + Number(n).toLocaleString('id-ID');
            }

            function computeNominal(harga, metode, diskonVal) {
                var d = Number(diskonVal);
                if (isNaN(d) || d < 0) {
                    d = 0;
                }
                if (metode === METODE_PRESENTASE) {
                    return Math.round(harga * d / 100);
                }
                return Math.round(d);
            }

            function getSelectedOption(selectEl) {
                if (!selectEl || selectEl.selectedIndex < 0) {
                    return null;
                }
                return selectEl.options[selectEl.selectedIndex];
            }

            function fillPreviewFromOption(opt) {
                document.getElementById('preview_id_pelanggan').textContent = opt && opt.dataset.idPelanggan ?
                    opt.dataset.idPelanggan : '—';
                document.getElementById('preview_nama_warga').textContent = opt && opt.dataset.namaWarga ? opt
                    .dataset.namaWarga : '—';
                document.getElementById('preview_alamat').textContent = opt && opt.dataset.alamat ? opt.dataset
                    .alamat : '—';
                document.getElementById('preview_nama_tipe').textContent = opt && opt.dataset.namaTipe ? opt.dataset
                    .namaTipe : '—';
                var h = opt && opt.dataset.harga ? parseMoneyInt(opt.dataset.harga) : 0;
                document.getElementById('preview_harga').textContent = h ? formatIdr(h) : '—';
                document.getElementById('preview_keterangan').textContent = opt && opt.dataset.keterangan ? opt
                    .dataset.keterangan : '—';
                return h;
            }

            function updateDiskonLabel() {
                var metode = document.getElementById('metode_diskon').value;
                var label = document.getElementById('label_diskon');
                var input = document.getElementById('diskon');
                if (metode === METODE_PRESENTASE) {
                    label.innerHTML = 'Persentase diskon (%) <span class="text-danger">*</span>';
                    input.setAttribute('max', '100');
                } else {
                    label.innerHTML = 'Nominal diskon (Rp) <span class="text-danger">*</span>';
                    input.removeAttribute('max');
                }
            }

            function refreshNominalPreview() {
                var select = document.getElementById('id_warga');
                var opt = getSelectedOption(select);
                var harga = fillPreviewFromOption(opt);
                var metode = document.getElementById('metode_diskon').value;
                var diskonVal = document.getElementById('diskon').value;
                var nominal = computeNominal(harga, metode, diskonVal);
                document.getElementById('preview_nominal').value = formatIdr(nominal);
            }

            document.addEventListener('DOMContentLoaded', function() {
                var $sel = window.jQuery && window.jQuery('.select2-pelanggan');
                if ($sel && $sel.select2) {
                    $sel.select2({
                        theme: 'bootstrap-5',
                        width: '100%',
                        placeholder: 'Cari pelanggan...',
                        allowClear: true
                    });
                    $sel.on('change', refreshNominalPreview);
                } else {
                    document.getElementById('id_warga').addEventListener('change', refreshNominalPreview);
                }

                document.getElementById('metode_diskon').addEventListener('change', function() {
                    updateDiskonLabel();
                    refreshNominalPreview();
                });
                document.getElementById('diskon').addEventListener('input', refreshNominalPreview);

                updateDiskonLabel();
                refreshNominalPreview();
            });
        })();
    </script>
@endpush
