@php
    $row = $lokasi ?? null;
    $metodeOld = old('metode_insentif', $row->metode_insentif ?? '');
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="nama_lokasi">Nama Lokasi <span class="text-danger">*</span></label>
        <input type="text" name="nama_lokasi" id="nama_lokasi" value="{{ old('nama_lokasi', $row->nama_lokasi ?? '') }}"
            class="form-control @error('nama_lokasi') is-invalid @enderror" required maxlength="50">
        @error('nama_lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="tlp_lokasi">Tlp Lokasi <span class="text-danger">*</span></label>
        <input type="text" name="tlp_lokasi" id="tlp_lokasi" value="{{ old('tlp_lokasi', $row->tlp_lokasi ?? '') }}"
            class="form-control @error('tlp_lokasi') is-invalid @enderror" required maxlength="50">
        @error('tlp_lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="alamat_lokasi">Alamat Lokasi <span class="text-danger">*</span></label>
        <textarea name="alamat_lokasi" id="alamat_lokasi" rows="3"
            class="form-control @error('alamat_lokasi') is-invalid @enderror" required>{{ old('alamat_lokasi', $row->alamat_lokasi ?? '') }}</textarea>
        @error('alamat_lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="group_wa">ID Group / Group WA</label>
        <input type="text" name="group_wa" id="group_wa" value="{{ old('group_wa', $row->group_wa ?? '') }}"
            class="form-control @error('group_wa') is-invalid @enderror" maxlength="50">
        @error('group_wa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="metode_insentif">Metode Insentif</label>
        <select name="metode_insentif" id="metode_insentif" class="form-select @error('metode_insentif') is-invalid @enderror">
            <option value="">— Tidak —</option>
            <option value="Nominal" @selected($metodeOld === 'Nominal')>Nominal</option>
            <option value="Presentase" @selected($metodeOld === 'Presentase')>Presentase</option>
        </select>
        @error('metode_insentif')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="insentif_sales">Insentif</label>
        <input type="text" inputmode="decimal" name="insentif_sales" id="insentif_sales"
            value="{{ old('insentif_sales', $row->insentif_sales ?? '') }}"
            class="form-control @error('insentif_sales') is-invalid @enderror">
        @error('insentif_sales')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="text-muted">Isi jika metode insentif dipilih (angka).</small>
    </div>
</div>
