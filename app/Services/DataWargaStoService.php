<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DataWargaStoService
{
    /**
     * @return array{pelanggan: \Illuminate\Support\Collection, lokasi: object|null, id_lokasi: int|null}
     */
    public function getData(string $account, int $idLokasi): array
    {
        $conn = DB::connection('tenant');
        $tbWarga = "tb_warga_{$account}";
        $schema = $conn->getSchemaBuilder();

        $lokasi = null;
        if ($schema->hasTable('tb_lokasi')) {
            $lokasi = $conn->table('tb_lokasi')
                ->where('account', $account)
                ->where('id_lokasi', $idLokasi)
                ->first();
        }

        if (! $schema->hasTable($tbWarga)) {
            return [
                'pelanggan' => collect([]),
                'lokasi' => $lokasi,
                'id_lokasi' => $idLokasi,
            ];
        }

        $pelanggan = $conn->table($tbWarga)
            ->where('account', $account)
            ->where('id_lokasi', $idLokasi)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->orderBy('nama_warga')
            ->get();

        return [
            'pelanggan' => $pelanggan,
            'lokasi' => $lokasi,
            'id_lokasi' => $idLokasi,
        ];
    }

    public function decodeIdLokasi(string $encoded): ?int
    {
        $decoded = base64_decode($encoded, true);
        if ($decoded === false || ! is_numeric($decoded)) {
            return null;
        }

        $id = (int) $decoded - 1991;

        return $id > 0 ? $id : null;
    }
}
