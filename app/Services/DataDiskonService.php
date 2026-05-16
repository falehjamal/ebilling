<?php

namespace App\Services;

use App\Enums\MetodeDiskon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DataDiskonService
{
    public function computeNominal(int $harga, string $metode, float $diskon): int
    {
        if ($metode === MetodeDiskon::Presentase->value) {
            return (int) round($harga * $diskon / 100);
        }

        return (int) round($diskon);
    }

    /**
     * @return Collection<int, object>
     */
    public function listForAccount(string $account): Collection
    {
        $conn = DB::connection('tenant');
        $schema = $conn->getSchemaBuilder();

        if (! $schema->hasTable('tb_diskon')) {
            return collect();
        }

        $hasLokasi = $schema->hasTable('tb_lokasi');

        $query = $conn->table('tb_diskon as d')
            ->where('d.account', $account)
            ->orderByDesc('d.id_diskon');

        if ($hasLokasi) {
            $query->leftJoin('tb_lokasi as l', function ($join) use ($account): void {
                $join->on('d.id_lokasi', '=', 'l.id_lokasi')
                    ->where('l.account', '=', $account);
            })->select('d.*', 'l.nama_lokasi');
        } else {
            $query->select('d.*');
        }

        $rows = $query->get();

        return $rows->map(function (object $row): object {
            if (! isset($row->nama_lokasi)) {
                $row->nama_lokasi = null;
            }
            $harga = $this->parseMoneyInt($row->harga ?? null);
            $nominal = $this->parseMoneyInt($row->nominal_diskon ?? null);
            $row->harga_setelah_diskon = max(0, $harga - $nominal);

            return $row;
        });
    }

    public function findForAccount(string $account, int $id): ?object
    {
        $conn = DB::connection('tenant');

        if (! $conn->getSchemaBuilder()->hasTable('tb_diskon')) {
            return null;
        }

        $row = $conn->table('tb_diskon')
            ->where('account', $account)
            ->where('id_diskon', $id)
            ->first();

        return $row ?: null;
    }

    /**
     * @return Collection<int, object>
     */
    public function pelangganOptions(string $account): Collection
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";

        if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
            return collect();
        }

        return $conn->table($tbWarga)
            ->where('account', $account)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->orderBy('nama_warga')
            ->get($this->pelangganSelectColumns());
    }

    public function findPelanggan(string $account, int $idWarga): ?object
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";

        if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
            return null;
        }

        $row = $conn->table($tbWarga)
            ->where('account', $account)
            ->where('id_warga', $idWarga)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->first($this->pelangganSelectColumns());

        return $row ?: null;
    }

    /**
     * Untuk mengisi dropdown edit jika baris snapshot tidak lagi memenuhi filter pelanggan aktif.
     */
    public function findWargaRow(string $account, int $idWarga): ?object
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";

        if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
            return null;
        }

        $row = $conn->table($tbWarga)
            ->where('account', $account)
            ->where('id_warga', $idWarga)
            ->first($this->pelangganSelectColumns());

        return $row ?: null;
    }

    /**
     * @return array<int, string>
     */
    private function pelangganSelectColumns(): array
    {
        return [
            'id_warga',
            'id_pelanggan',
            'nama_warga',
            'alamat',
            'nama_tipe',
            'harga',
            'keterangan',
            'id_lokasi',
            'id_tipe_pembayaran',
        ];
    }

    /**
     * @return Collection<int, object>
     */
    public function pelangganOptionsWithFallback(string $account, ?int $idWargaFallback): Collection
    {
        $opts = $this->pelangganOptions($account);
        if ($idWargaFallback !== null && $opts->firstWhere('id_warga', $idWargaFallback) === null) {
            $row = $this->findWargaRow($account, $idWargaFallback);
            if ($row !== null) {
                $opts = collect([$row])->merge($opts);
            }
        }

        return $opts;
    }

    /**
     * @param  array{id_warga: int, nama_diskon: string, metode_diskon: string, diskon: float|int|string}  $data
     */
    public function create(string $account, array $data): int
    {
        $w = $this->findPelanggan($account, (int) $data['id_warga']);
        if ($w === null) {
            return 0;
        }

        $hargaInt = $this->parseMoneyInt($w->harga ?? null);
        $diskonFloat = (float) $data['diskon'];
        $nominal = $this->computeNominal($hargaInt, $data['metode_diskon'], $diskonFloat);

        $conn = DB::connection('tenant');
        $payload = $this->buildDiskonPayload($account, $w, $data['nama_diskon'], $data['metode_diskon'], $diskonFloat, $nominal);

        return (int) $conn->table('tb_diskon')->insertGetId($payload);
    }

    /**
     * @param  array{id_warga: int, nama_diskon: string, metode_diskon: string, diskon: float|int|string}  $data
     */
    public function update(string $account, int $id, array $data): bool
    {
        $w = $this->findPelanggan($account, (int) $data['id_warga']);
        if ($w === null) {
            return false;
        }

        $hargaInt = $this->parseMoneyInt($w->harga ?? null);
        $diskonFloat = (float) $data['diskon'];
        $nominal = $this->computeNominal($hargaInt, $data['metode_diskon'], $diskonFloat);

        $conn = DB::connection('tenant');
        $payload = $this->buildDiskonPayload($account, $w, $data['nama_diskon'], $data['metode_diskon'], $diskonFloat, $nominal);
        unset($payload['account']);

        $affected = $conn->table('tb_diskon')
            ->where('account', $account)
            ->where('id_diskon', $id)
            ->update($payload);

        return $affected > 0;
    }

    public function delete(string $account, int $id): bool
    {
        $conn = DB::connection('tenant');

        $deleted = $conn->table('tb_diskon')
            ->where('account', $account)
            ->where('id_diskon', $id)
            ->delete();

        return $deleted > 0;
    }

    /**
     * @return array<string, mixed>
     */
    private function buildDiskonPayload(
        string $account,
        object $w,
        string $namaDiskon,
        string $metodeDiskon,
        float $diskon,
        int $nominalDiskon
    ): array {
        $idLokasi = $w->id_lokasi ?? null;
        $idTipe = $w->id_tipe_pembayaran ?? null;

        return [
            'account' => (int) $account,
            'id_warga' => (int) $w->id_warga,
            'id_pelanggan' => $this->clipString((string) ($w->id_pelanggan ?? ''), 255),
            'nama_warga' => $this->clipString((string) ($w->nama_warga ?? ''), 50),
            'alamat' => $this->clipString((string) ($w->alamat ?? ''), 50),
            'nama_tipe' => $this->clipString((string) ($w->nama_tipe ?? ''), 50),
            'harga' => $this->clipString((string) ($this->parseMoneyInt($w->harga ?? 0)), 50),
            'keterangan' => $this->clipString((string) ($w->keterangan ?? ''), 50),
            'nama_diskon' => $this->clipString($namaDiskon, 200),
            'metode_diskon' => $metodeDiskon,
            'diskon' => $this->clipString((string) (int) round($diskon), 50),
            'nominal_diskon' => $this->clipString((string) $nominalDiskon, 50),
            'id_lokasi' => $idLokasi === null || $idLokasi === '' ? null : $this->clipString((string) $idLokasi, 255),
            'id_tipe_pembayaran' => $idTipe === null || $idTipe === '' ? null : $this->clipString((string) $idTipe, 255),
        ];
    }

    private function clipString(string $value, int $max): string
    {
        $t = trim($value);

        return mb_substr($t, 0, $max);
    }

    private function parseMoneyInt(mixed $value): int
    {
        if ($value === null || $value === '') {
            return 0;
        }
        if (is_int($value)) {
            return $value;
        }
        if (is_numeric($value)) {
            return (int) round((float) $value);
        }
        $digits = preg_replace('/[^\d\-]/', '', (string) $value);
        if ($digits === '' || $digits === '-') {
            return 0;
        }

        return (int) $digits;
    }
}
