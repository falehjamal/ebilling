<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DataLokasiService
{
    /**
     * @return Collection<int, object>
     */
    public function listForAccount(string $account): Collection
    {
        $conn = DB::connection('tenant');
        $schema = $conn->getSchemaBuilder();

        if (! $schema->hasTable('tb_lokasi')) {
            return collect();
        }

        $tbWarga = "tb_warga_{$account}";
        $hasWarga = $schema->hasTable($tbWarga);

        $rows = $conn->table('tb_lokasi')
            ->where('account', $account)
            ->orderBy('nama_lokasi')
            ->get();

        if (! $hasWarga) {
            return $rows->map(function (object $row): object {
                $row->jumlah_pelanggan = 0;

                return $row;
            });
        }

        return $rows->map(function (object $row) use ($conn, $tbWarga, $account): object {
            $row->jumlah_pelanggan = (int) $conn->table($tbWarga)
                ->where('account', $account)
                ->where('id_lokasi', $row->id_lokasi)
                ->where('status', '1')
                ->where('level', 'Pelanggan')
                ->count();

            return $row;
        });
    }

    public function findForAccount(string $account, int $id): ?object
    {
        $conn = DB::connection('tenant');

        if (! $conn->getSchemaBuilder()->hasTable('tb_lokasi')) {
            return null;
        }

        $row = $conn->table('tb_lokasi')
            ->where('account', $account)
            ->where('id_lokasi', $id)
            ->first();

        return $row ?: null;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(string $account, array $data): int
    {
        $conn = DB::connection('tenant');

        $metode = $data['metode_insentif'] ?? null;
        $insentif = $data['insentif_sales'] ?? null;
        if ($metode === null || $metode === '') {
            $insentif = null;
            $metodeNormalized = null;
        } else {
            $metodeNormalized = $metode;
        }

        $payload = [
            'account' => $account,
            'nama_lokasi' => $data['nama_lokasi'],
            'alamat_lokasi' => $data['alamat_lokasi'],
            'tlp_lokasi' => $data['tlp_lokasi'],
            'group_wa' => $this->normalizeGroupWa($data['group_wa'] ?? null),
            'metode_insentif' => $metodeNormalized,
            'insentif_sales' => $insentif,
            'filter_lokasi' => 'Tidak',
            'jns_lokasi' => 'POP',
        ];

        return (int) $conn->table('tb_lokasi')->insertGetId($payload);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(string $account, int $id, array $data): bool
    {
        $conn = DB::connection('tenant');

        $metode = $data['metode_insentif'] ?? null;
        $insentif = $data['insentif_sales'] ?? null;
        if ($metode === null || $metode === '') {
            $insentif = null;
        }

        $affected = $conn->table('tb_lokasi')
            ->where('account', $account)
            ->where('id_lokasi', $id)
            ->update([
                'nama_lokasi' => $data['nama_lokasi'],
                'alamat_lokasi' => $data['alamat_lokasi'],
                'tlp_lokasi' => $data['tlp_lokasi'],
                'group_wa' => $this->normalizeGroupWa($data['group_wa'] ?? null),
                'metode_insentif' => $metode ?: null,
                'insentif_sales' => $insentif,
            ]);

        return $affected > 0;
    }

    private function normalizeGroupWa(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '0';
        }

        return (string) $value;
    }

    public function countActivePelanggan(string $account, int $idLokasi): int
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";

        if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
            return 0;
        }

        return (int) $conn->table($tbWarga)
            ->where('account', $account)
            ->where('id_lokasi', $idLokasi)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->count();
    }

    public function delete(string $account, int $id): bool
    {
        $conn = DB::connection('tenant');

        $deleted = $conn->table('tb_lokasi')
            ->where('account', $account)
            ->where('id_lokasi', $id)
            ->delete();

        return $deleted > 0;
    }
}
