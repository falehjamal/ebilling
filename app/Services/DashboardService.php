<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getStats(string $account): array
    {
        $conn = DB::connection('tenant');
        $schema = $conn->getSchemaBuilder();

        $tglskg = now()->startOfMonth()->format('Y-m-d');
        $awalbulan = now()->startOfMonth()->format('Y-m-d');
        $awal = now()->startOfMonth()->format('Y-m-d 00:00:00');
        $akhir = now()->endOfMonth()->format('Y-m-d 00:00:00');
        $akhirbulan = now()->endOfMonth()->format('Y-m-d');
        $tglbulankemaren = now()->subMonth()->startOfMonth()->format('Y-m-d');
        $hariini = now()->format('Y-m-d');
        $bulaninii = now()->translatedFormat('F Y');

        $tbWarga = "tb_warga_{$account}";
        $tbIuran = "tb_iuran_{$account}";

        $defaults = [
            'warga' => 0,
            'warga_baru' => 0,
            'harga_baru' => 0,
            'on' => 0,
            'off' => 0,
            'sudahbayar' => 0,
            'total_lunas' => 0,
            'belumbayar' => 0,
            'jumlah_bayar' => 0,
            'laporanopen' => 0,
            'laporanaktivasi' => 0,
            'laporanpending' => 0,
            'laporanpenanganan' => 0,
            'laporanclosed' => 0,
            'totaltrxhariini' => 0,
            'total_iuran_hariini' => 0,
            'total_iuran' => 0,
            'total_pengeluaran' => 0,
            'balance' => 0,
            'bulaninii' => $bulaninii,
            'pelangganBaru' => [],
            'transaksiTerakhir' => [],
        ];

        if (! $schema->hasTable($tbWarga)) {
            return $defaults;
        }

        $warga = $conn->table($tbWarga)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->where('account', $account)
            ->count();
        $defaults['warga'] = $warga;

        $wargaBaru = $conn->table($tbWarga)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->where('account', $account)
            ->whereBetween('tgl_registrasi', [$awalbulan, $akhirbulan])
            ->selectRaw('count(*) as warga_baru, coalesce(sum(harga), 0) as harga_baru')
            ->first();
        if ($wargaBaru) {
            $defaults['warga_baru'] = (int) $wargaBaru->warga_baru;
            $defaults['harga_baru'] = (float) $wargaBaru->harga_baru;
        }

        $on = $conn->table($tbWarga)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->where('account', $account)
            ->where('status_langganan', 'On')
            ->count();
        $defaults['on'] = $on;

        $off = $conn->table($tbWarga)
            ->where('status', '1')
            ->where('level', 'Pelanggan')
            ->where('account', $account)
            ->where('status_langganan', 'Off')
            ->count();
        $defaults['off'] = $off;

        if ($schema->hasTable($tbIuran)) {
            $sudahbayar = $conn->table($tbIuran)
                ->where('bayar_bulan', $tglskg)
                ->where('jns_tipe_pembayaran', 'Wajib Tiap Bulan')
                ->selectRaw('count(*) as sudahbayar, coalesce(sum(jumlah_bayar), 0) as jumlah_bayar')
                ->first();
            if ($sudahbayar) {
                $defaults['sudahbayar'] = (int) $sudahbayar->sudahbayar;
                $defaults['total_lunas'] = (float) $sudahbayar->jumlah_bayar;
            }

            $belumbayar = $this->getBelumBayar($conn, $tbWarga, $tbIuran, $account, $tglskg, $tglbulankemaren);
            $defaults['belumbayar'] = $belumbayar['belumbayar'];
            $defaults['jumlah_bayar'] = $belumbayar['jumlah_bayar'];

            $trxHariini = $conn->table($tbIuran)
                ->where('account', $account)
                ->whereDate('wkt_entry', $hariini)
                ->selectRaw('count(*) as totaltrxhariini, coalesce(sum(jumlah_bayar), 0) as jumlah_bayar')
                ->first();
            if ($trxHariini) {
                $defaults['totaltrxhariini'] = (int) $trxHariini->totaltrxhariini;
                $defaults['total_iuran_hariini'] = (float) $trxHariini->jumlah_bayar;
            }

            $totalIuran = $conn->table($tbIuran)
                ->where('account', $account)
                ->whereBetween('wkt_entry', [$awal, $akhir])
                ->sum('jumlah_bayar');
            $defaults['total_iuran'] = (float) $totalIuran;

            $defaults['pelangganBaru'] = $this->getPelangganBaru($conn, $tbWarga, $awalbulan, $akhirbulan);
            $defaults['transaksiTerakhir'] = $this->getTransaksiTerakhir($conn, $tbIuran, $tbWarga, $account);
        }

        if ($schema->hasTable('tb_laporan_pelanggan')) {
            $defaults['laporanopen'] = $conn->table('tb_laporan_pelanggan')
                ->where('account', $account)
                ->where('status', 'Open')
                ->count();
            $defaults['laporanaktivasi'] = $conn->table('tb_laporan_pelanggan')
                ->where('account', $account)
                ->where('status', 'Permintaan Aktivasi')
                ->count();
            $defaults['laporanpending'] = $conn->table('tb_laporan_pelanggan')
                ->where('account', $account)
                ->where('status', 'Pending')
                ->count();
            $defaults['laporanpenanganan'] = $conn->table('tb_laporan_pelanggan')
                ->where('account', $account)
                ->where('status', 'Dalam Penanganan')
                ->count();
            $defaults['laporanclosed'] = $conn->table('tb_laporan_pelanggan')
                ->where('account', $account)
                ->where('status', 'closed')
                ->whereBetween('waktu_masuk', [$awal, $akhir])
                ->count();
        }

        if ($schema->hasTable('tb_pengeluaran')) {
            $totalPengeluaran = $conn->table('tb_pengeluaran')
                ->where('account', $account)
                ->whereBetween('waktu_pengeluaran', [$awal, $akhir])
                ->sum('jml_pengeluaran');
            $defaults['total_pengeluaran'] = (float) $totalPengeluaran;
        }

        $defaults['balance'] = $defaults['total_iuran'] - $defaults['total_pengeluaran'];

        return $defaults;
    }

    /**
     * @return array{belumbayar: int, jumlah_bayar: float}
     */
    private function getBelumBayar($conn, string $tbWarga, string $tbIuran, string $account, string $tglskg, string $tglbulankemaren): array
    {
        $result = $conn->table(DB::raw("`{$tbWarga}` as a"))
            ->leftJoin(DB::raw("`{$tbIuran}` as b"), function ($join) use ($tglskg) {
                $join->on('b.id_warga', '=', 'a.id_warga')
                    ->whereBetween('b.bayar_bulan', [$tglskg, $tglskg]);
            })
            ->whereNull('b.id_warga')
            ->where('a.account', $account)
            ->where('a.level', 'Pelanggan')
            ->where('a.status', '1')
            ->where('a.harga', '!=', '0')
            ->where('a.tgl_registrasi', '<', $tglskg)
            ->selectRaw('count(*) as belumbayar, coalesce(sum(a.harga), 0) as jumlah_bayar')
            ->first();

        return [
            'belumbayar' => $result ? (int) $result->belumbayar : 0,
            'jumlah_bayar' => $result ? (float) $result->jumlah_bayar : 0,
        ];
    }

    /**
     * @return array<int, object{nama_warga: string, tgl_registrasi: string, nama_lokasi: string}>
     */
    private function getPelangganBaru($conn, string $tbWarga, string $awalbulan, string $akhirbulan): array
    {
        $hasLokasi = $conn->getSchemaBuilder()->hasTable('tb_lokasi');

        $query = $conn->table($tbWarga)
            ->where('level', 'Pelanggan')
            ->where('status', '1')
            ->whereBetween('tgl_registrasi', [$awalbulan, $akhirbulan])
            ->orderByDesc('id_warga')
            ->limit(8)
            ->get(['id_warga', 'nama_warga', 'id_lokasi', 'tgl_registrasi']);

        if ($query->isEmpty()) {
            return [];
        }

        return $query->map(function ($row) use ($conn, $hasLokasi) {
            $namaLokasi = '';
            if ($hasLokasi && $row->id_lokasi) {
                $lokasi = $conn->table('tb_lokasi')
                    ->where('id_lokasi', $row->id_lokasi)
                    ->value('nama_lokasi');
                $namaLokasi = $lokasi ?? '';
            }

            return (object) [
                'nama_warga' => $row->nama_warga ?? '',
                'tgl_registrasi' => $row->tgl_registrasi ?? '',
                'nama_lokasi' => $namaLokasi,
            ];
        })->all();
    }

    /**
     * @return array<int, object{nama_warga: string, jumlah_bayar: float, wkt_entry: string, jns_tipe_pembayaran: string|null}>
     */
    private function getTransaksiTerakhir($conn, string $tbIuran, string $tbWarga, string $account): array
    {
        $rows = $conn->table(DB::raw("`{$tbIuran}` as i"))
            ->leftJoin(DB::raw("`{$tbWarga}` as w"), 'w.id_warga', '=', 'i.id_warga')
            ->where('i.account', $account)
            ->orderByDesc('i.wkt_entry')
            ->limit(8)
            ->get(['i.id_warga', 'i.jumlah_bayar', 'i.wkt_entry', 'i.jns_tipe_pembayaran', 'w.nama_warga']);

        return $rows->map(function ($row) {
            return (object) [
                'nama_warga' => $row->nama_warga ?? '-',
                'jumlah_bayar' => (float) ($row->jumlah_bayar ?? 0),
                'wkt_entry' => $row->wkt_entry ?? '',
                'jns_tipe_pembayaran' => $row->jns_tipe_pembayaran ?? null,
            ];
        })->all();
    }
}
