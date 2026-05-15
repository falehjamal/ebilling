<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DataTipePembayaranService
{
    /**
     * @return Collection<int, object>
     */
    public function listForAccount(string $account): Collection
    {
        $conn = DB::connection('tenant');
        $schema = $conn->getSchemaBuilder();

        if (! $schema->hasTable('tb_tipe_pembayaran')) {
            return collect();
        }

        $hasLokasi = $schema->hasTable('tb_lokasi');

        $query = $conn->table('tb_tipe_pembayaran as t')
            ->where('t.account', $account)
            ->orderByDesc('t.id_tipe_pembayaran');

        if ($hasLokasi) {
            $query->leftJoin('tb_lokasi as l', function ($join) use ($account): void {
                $join->on('t.id_lokasi', '=', 'l.id_lokasi')
                    ->where('l.account', '=', $account);
            })->select('t.*', 'l.nama_lokasi');
        } else {
            $query->select('t.*');
        }

        $rows = $query->get();

        $counts = $this->pelangganCountsByTipePembayaran($account);

        return $rows->map(function (object $row) use ($counts): object {
            $id = (int) $row->id_tipe_pembayaran;
            $row->jumlah_pelanggan = (int) ($counts[$id] ?? 0);
            if (! isset($row->nama_lokasi)) {
                $row->nama_lokasi = null;
            }

            return $row;
        });
    }

    /**
     * @return array<int, int>
     */
    public function pelangganCountsByTipePembayaran(string $account): array
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";

        if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
            return [];
        }

        $rows = $conn->table($tbWarga)
            ->selectRaw('id_tipe_pembayaran, COUNT(*) as cnt')
            ->where('account', $account)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->whereNotNull('id_tipe_pembayaran')
            ->groupBy('id_tipe_pembayaran')
            ->get();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row->id_tipe_pembayaran] = (int) $row->cnt;
        }

        return $map;
    }

    public function findForAccount(string $account, int $id): ?object
    {
        $conn = DB::connection('tenant');

        if (! $conn->getSchemaBuilder()->hasTable('tb_tipe_pembayaran')) {
            return null;
        }

        $row = $conn->table('tb_tipe_pembayaran')
            ->where('account', $account)
            ->where('id_tipe_pembayaran', $id)
            ->first();

        return $row ?: null;
    }

    /**
     * @return Collection<int, object>
     */
    public function lokasiOptions(string $account): Collection
    {
        $conn = DB::connection('tenant');

        if (! $conn->getSchemaBuilder()->hasTable('tb_lokasi')) {
            return collect();
        }

        return $conn->table('tb_lokasi')
            ->where('account', $account)
            ->orderBy('nama_lokasi')
            ->get(['id_lokasi', 'nama_lokasi']);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(string $account, array $data): int
    {
        $conn = DB::connection('tenant');

        $payload = [
            'account' => (int) $account,
            'nama_tipe' => $data['nama_tipe'],
            'keterangan' => $data['keterangan'] ?? null,
            'harga' => $data['harga'],
            'jns_tipe_pembayaran' => $data['jns_tipe_pembayaran'],
            'id_lokasi' => $data['id_lokasi'] ?? null,
            'profile' => $data['profile'] ?? null,
            'registrasi' => $data['registrasi'],
            'filter_lokasi' => $data['filter_lokasi'],
            'wkt_update' => now(),
        ];

        return (int) $conn->table('tb_tipe_pembayaran')->insertGetId($payload);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $account, int $id, array $data): bool
    {
        $conn = DB::connection('tenant');

        $affected = $conn->table('tb_tipe_pembayaran')
            ->where('account', $account)
            ->where('id_tipe_pembayaran', $id)
            ->update([
                'nama_tipe' => $data['nama_tipe'],
                'keterangan' => $data['keterangan'] ?? null,
                'harga' => $data['harga'],
                'jns_tipe_pembayaran' => $data['jns_tipe_pembayaran'],
                'id_lokasi' => $data['id_lokasi'] ?? null,
                'profile' => $data['profile'] ?? null,
                'registrasi' => $data['registrasi'],
                'filter_lokasi' => $data['filter_lokasi'],
                'wkt_update' => now(),
            ]);

        return $affected > 0;
    }

    public function countPelangganByTipe(string $account, int $idTipePembayaran): int
    {
        $counts = $this->pelangganCountsByTipePembayaran($account);

        return (int) ($counts[$idTipePembayaran] ?? 0);
    }

    public function delete(string $account, int $id): bool
    {
        $conn = DB::connection('tenant');

        $deleted = $conn->table('tb_tipe_pembayaran')
            ->where('account', $account)
            ->where('id_tipe_pembayaran', $id)
            ->delete();

        return $deleted > 0;
    }

    public function syncPaketPelanggan(string $account, int $idTipePembayaran, bool $enabled): void
    {
        if (! $enabled) {
            return;
        }

        // TODO: sinkronisasi kolom paket di tb_warga_{account} saat spesifikasi kolom final.
    }

    public function syncPaketPpnPelanggan(string $account, int $idTipePembayaran, bool $enabled): void
    {
        if (! $enabled) {
            return;
        }

        // TODO: sinkronisasi PPN paket di tb_warga_{account} saat spesifikasi kolom final.
    }
}
