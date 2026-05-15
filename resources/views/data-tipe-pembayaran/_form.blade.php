@php
    $row = $tipePembayaran ?? null;
    $mode = $mode ?? 'create';
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="nama_tipe">Nama Tipe <span class="text-danger">*</span></label>
        <input type="text" name="nama_tipe" id="nama_tipe" value="{{ old('nama_tipe', $row->nama_tipe ?? '') }}"
            class="form-control @error('nama_tipe') is-invalid @enderror" required maxlength="200">
        @error('nama_tipe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="keterangan_tipe">Keterangan Tipe</label>
        <input type="text" name="keterangan_tipe" id="keterangan_tipe"
            value="{{ old('keterangan_tipe', $row->keterangan ?? '') }}"
            class="form-control @error('keterangan_tipe') is-invalid @enderror" maxlength="200">
        @error('keterangan_tipe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="harga_tipe">Harga Tipe <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" name="harga_tipe" id="harga_tipe" inputmode="numeric" min="0" step="1"
                value="{{ old('harga_tipe', isset($row->harga) ? (int) $row->harga : '') }}"
                class="form-control @error('harga_tipe') is-invalid @enderror" required>
            @error('harga_tipe')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="jenis_tipe_pembayaran">Jenis Tipe Pembayaran <span
                class="text-danger">*</span></label>
        <select name="jenis_tipe_pembayaran" id="jenis_tipe_pembayaran"
            class="form-select @error('jenis_tipe_pembayaran') is-invalid @enderror" required>
            @php($jenisOld = old('jenis_tipe_pembayaran', $row->jns_tipe_pembayaran ?? ''))
            <option value="">— Pilih —</option>
            <option value="Wajib Tiap Bulan" @selected($jenisOld === 'Wajib Tiap Bulan')>Wajib Tiap Bulan</option>
            <option value="Tidak Wajib Tiap Bulan" @selected($jenisOld === 'Tidak Wajib Tiap Bulan')>Tidak Wajib Tiap
                Bulan</option>
        </select>
        @error('jenis_tipe_pembayaran')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="lokasi">Lokasi</label>
        <select name="lokasi" id="lokasi" class="form-select @error('lokasi') is-invalid @enderror">
            @php($lokasiOld = old('lokasi', $row->id_lokasi ?? ''))
            <option value="">— Tidak Dipilih —</option>
            @foreach ($lokasiOptions ?? collect() as $opt)
                <option value="{{ $opt->id_lokasi }}" @selected((string) $lokasiOld === (string) $opt->id_lokasi)>
                    {{ $opt->nama_lokasi ?? 'Lokasi #' . $opt->id_lokasi }}
                </option>
            @endforeach
        </select>
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="profile">Profile</label>
        <input type="text" name="profile" id="profile" value="{{ old('profile', $row->profile ?? '') }}"
            class="form-control @error('profile') is-invalid @enderror" maxlength="50">
        @error('profile')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="tampilkan_paket_di_registrasi">Tampilkan Paket Di Registrasi <span
                class="text-danger">*</span></label>
        <select name="tampilkan_paket_di_registrasi" id="tampilkan_paket_di_registrasi"
            class="form-select @error('tampilkan_paket_di_registrasi') is-invalid @enderror" required>
            @php($regOld = old('tampilkan_paket_di_registrasi', $row->registrasi ?? 'Ya'))
            <option value="Ya" @selected($regOld === 'Ya')>Ya</option>
            <option value="Tidak" @selected($regOld === 'Tidak')>Tidak</option>
        </select>
        @error('tampilkan_paket_di_registrasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if ($mode === 'edit')
        <div class="col-12">
            <div class="form-check mb-2">
                <input type="checkbox" name="ubah_data_paket_pelanggan" id="ubah_data_paket_pelanggan" value="1"
                    class="form-check-input @error('ubah_data_paket_pelanggan') is-invalid @enderror"
                    @checked(old('ubah_data_paket_pelanggan'))>
                <label class="form-check-label" for="ubah_data_paket_pelanggan">Ubah Data Paket Pelanggan</label>
                @error('ubah_data_paket_pelanggan')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" name="ubah_data_paket_ppn_pelanggan" id="ubah_data_paket_ppn_pelanggan" value="1"
                    class="form-check-input @error('ubah_data_paket_ppn_pelanggan') is-invalid @enderror"
                    @checked(old('ubah_data_paket_ppn_pelanggan'))>
                <label class="form-check-label" for="ubah_data_paket_ppn_pelanggan">Ubah Data Paket PPN
                    Pelanggan</label>
                @error('ubah_data_paket_ppn_pelanggan')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    @endif
    <div class="col-md-6">
        <label class="form-label" for="filter_harga_lokasi">Filter Harga Lokasi <span
                class="text-danger">*</span></label>
        <select name="filter_harga_lokasi" id="filter_harga_lokasi"
            class="form-select @error('filter_harga_lokasi') is-invalid @enderror" required>
            @php($filtOld = old('filter_harga_lokasi', $row->filter_lokasi ?? 'Tidak'))
            <option value="Ya" @selected($filtOld === 'Ya')>Ya</option>
            <option value="Tidak" @selected($filtOld === 'Tidak')>Tidak</option>
        </select>
        @error('filter_harga_lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
