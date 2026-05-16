@php
    $row = $diskon ?? null;
    $mode = $mode ?? 'create';
@endphp

<div class="row g-3">
    <div class="col-12">
        <label class="form-label" for="id_warga">Pelanggan <span class="text-danger">*</span></label>
        <select name="id_warga" id="id_warga" class="form-select select2-pelanggan @error('id_warga') is-invalid @enderror"
            required data-placeholder="Cari pelanggan...">
            <option value=""></option>
            @foreach ($pelangganOptions ?? collect() as $p)
                @php($optId = (int) $p->id_warga)
                @php($sel = (string) old('id_warga', $row->id_warga ?? '') === (string) $optId)
                <option value="{{ $optId }}" @selected($sel)
                    data-id-pelanggan="{{ e((string) ($p->id_pelanggan ?? '')) }}"
                    data-nama-warga="{{ e((string) ($p->nama_warga ?? '')) }}"
                    data-alamat="{{ e((string) ($p->alamat ?? '')) }}"
                    data-nama-tipe="{{ e((string) ($p->nama_tipe ?? '')) }}"
                    data-harga="{{ e((string) ($p->harga ?? '')) }}"
                    data-keterangan="{{ e((string) ($p->keterangan ?? '')) }}">
                    {{ e((string) ($p->id_pelanggan ?? $optId)) }} — {{ e((string) ($p->nama_warga ?? '')) }}
                </option>
            @endforeach
        </select>
        @error('id_warga')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <div class="card bg-label-secondary bg-opacity-10 border-0">
            <div class="card-body py-3">
                <div class="small text-muted mb-1">Data paket / pelanggan (otomatis)</div>
                <div class="row g-2 small">
                    <div class="col-md-4"><strong>ID Pelanggan:</strong> <span id="preview_id_pelanggan">—</span></div>
                    <div class="col-md-4"><strong>Nama:</strong> <span id="preview_nama_warga">—</span></div>
                    <div class="col-12"><strong>Alamat:</strong> <span id="preview_alamat">—</span></div>
                    <div class="col-md-4"><strong>Nama langganan:</strong> <span id="preview_nama_tipe">—</span></div>
                    <div class="col-md-4"><strong>Harga paket:</strong> <span id="preview_harga">—</span></div>
                    <div class="col-12"><strong>Keterangan:</strong> <span id="preview_keterangan">—</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="nama_diskon">Nama Diskon <span class="text-danger">*</span></label>
        <input type="text" name="nama_diskon" id="nama_diskon"
            value="{{ old('nama_diskon', $row->nama_diskon ?? '') }}"
            class="form-control @error('nama_diskon') is-invalid @enderror" required maxlength="200">
        @error('nama_diskon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="metode_diskon">Metode Diskon <span class="text-danger">*</span></label>
        <select name="metode_diskon" id="metode_diskon"
            class="form-select @error('metode_diskon') is-invalid @enderror" required>
            @php($metodeOld = old('metode_diskon', $row->metode_diskon ?? \App\Enums\MetodeDiskon::Nominal->value))
            <option value="{{ \App\Enums\MetodeDiskon::Nominal->value }}" @selected($metodeOld === \App\Enums\MetodeDiskon::Nominal->value)>
                Nominal</option>
            <option value="{{ \App\Enums\MetodeDiskon::Presentase->value }}" @selected($metodeOld === \App\Enums\MetodeDiskon::Presentase->value)>
                Presentase</option>
        </select>
        @error('metode_diskon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="diskon" id="label_diskon">Nilai diskon <span
                class="text-danger">*</span></label>
        <input type="number" name="diskon" id="diskon" inputmode="decimal" step="any" min="0"
            value="{{ old('diskon', isset($row->diskon) ? $row->diskon : '') }}"
            class="form-control @error('diskon') is-invalid @enderror" required>
        @error('diskon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="preview_nominal">Preview nominal diskon</label>
        <input type="text" id="preview_nominal" class="form-control" readonly value="Rp 0">
    </div>
</div>
