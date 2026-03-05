<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardCabangService
{
    /**
     * @return array{cabang: array, summary: array, tgl1: string, tgl2: string, tglbulanini: string, tglskg: string}
     */
    public function getData(string $account, ?string $tgl = null): array
    {
        $conn = DB::connection('tenant');
        $schema = $conn->getSchemaBuilder();

        $tglskg = $tgl
            ? (date('Y-m-d', strtotime($tgl)) ?: now()->startOfMonth()->format('Y-m-d'))
            : now()->startOfMonth()->format('Y-m-d');
        $awalbulan = date('Y-m-d', strtotime('first day of this month', strtotime($tglskg)));
        $akhirbulan = date('Y-m-d', strtotime('last day of this month', strtotime($tglskg)));
        $awal = $awalbulan.' 00:00:00';
        $akhir = $akhirbulan.' 23:59:59';
        $tgl1 = $awalbulan;
        $tgl2 = $akhirbulan;
        $tglbulanini = now()->parse($tglskg)->translatedFormat('F Y');

        $tbWarga = "tb_warga_{$account}";
        $tbIuran = "tb_iuran_{$account}";

        $cabang = [];
        $summary = [
            'total_pelanggan' => 0,
            'total_pelanggan_baru' => 0,
            'total_pelanggan_free' => 0,
            'total_pemasukan' => 0.0,
            'total_pengeluaran' => 0.0,
            'balance' => 0.0,
            'total_estimasi' => 0.0,
        ];

        if (! $schema->hasTable('tb_lokasi') || ! $schema->hasTable($tbWarga)) {
            return [
                'cabang' => [],
                'summary' => $summary,
                'tgl1' => $tgl1,
                'tgl2' => $tgl2,
                'tglbulanini' => $tglbulanini,
                'tglskg' => $tglskg,
            ];
        }

        $lokasiList = $conn->table('tb_lokasi')
            ->where('account', $account)
            ->get();

        foreach ($lokasiList as $lokasi) {
            $idLokasi = $lokasi->id_lokasi;
            $row = (object) [
                'id_lokasi' => $idLokasi,
                'nama_lokasi' => $lokasi->nama_lokasi ?? '',
                'kode_lokasi' => $lokasi->kode_lokasi ?? '',
                'nama_pic' => $lokasi->nama_pic ?? '',
                'metode_insentif' => $lokasi->metode_insentif ?? '',
                'insentif_sales' => $lokasi->insentif_sales ?? 0,
                'jumlahpelanggan' => 0,
                'total_pelanggan_baru' => 0,
                'total_pelanggan_free' => 0,
                'sudahbayar' => 0,
                'belumbayar' => 0,
                'total_iuran' => 0.0,
                'jml_pengeluaran' => 0.0,
                'balance' => 0.0,
                'insentif' => 0.0,
                'insentif_label' => '',
                'total_estimasi' => 0.0,
            ];

            $row->jumlahpelanggan = (int) $conn->table($tbWarga)
                ->where('status', '1')
                ->where('level', 'Pelanggan')
                ->where('id_lokasi', $idLokasi)
                ->count();

            $pelangganBaru = $conn->table($tbWarga)
                ->where('status', '1')
                ->where('level', 'Pelanggan')
                ->where('id_lokasi', $idLokasi)
                ->whereBetween('tgl_registrasi', [$awalbulan, $akhirbulan])
                ->count();
            $row->total_pelanggan_baru = (int) $pelangganBaru;
            $summary['total_pelanggan_baru'] += $pelangganBaru;

            $pelangganFree = $conn->table($tbWarga)
                ->where('status', '1')
                ->where('level', 'Pelanggan')
                ->where('id_lokasi', $idLokasi)
                ->where('harga', '0')
                ->count();
            $row->total_pelanggan_free = (int) $pelangganFree;
            $summary['total_pelanggan_free'] += $pelangganFree;

            if ($schema->hasTable($tbIuran)) {
                $sudahbayar = $conn->table($tbIuran)
                    ->where('bayar_bulan', $tglskg)
                    ->where('id_lokasi', $idLokasi)
                    ->count();
                $row->sudahbayar = (int) $sudahbayar;

                $belumbayar = $this->getBelumBayarPerLokasi($conn, $tbWarga, $tbIuran, $account, $tglskg, $idLokasi);
                $row->belumbayar = $belumbayar;

                $totalIuran = $conn->table($tbIuran)
                    ->where('id_lokasi', $idLokasi)
                    ->whereBetween('wkt_entry', [$awal, $akhir])
                    ->sum('jumlah_bayar');
                $row->total_iuran = (float) $totalIuran;
                $summary['total_pemasukan'] += $row->total_iuran;
            }

            if ($schema->hasTable('tb_pengeluaran')) {
                $jmlPengeluaran = $conn->table('tb_pengeluaran')
                    ->where('id_lokasi', $idLokasi)
                    ->where('account', $account)
                    ->whereBetween('waktu_pengeluaran', [$awal, $akhir])
                    ->sum('jml_pengeluaran');
                $row->jml_pengeluaran = (float) $jmlPengeluaran;
                $summary['total_pengeluaran'] += $row->jml_pengeluaran;
            }

            $row->balance = $row->total_iuran - $row->jml_pengeluaran;

            $metode = $row->metode_insentif;
            $insentifSales = (float) ($row->insentif_sales ?? 0);
            if ($metode === 'Presentase') {
                $row->insentif = $row->total_iuran * $insentifSales / 100;
                $row->insentif_label = format_idr($row->insentif);
            } elseif ($metode === 'Nominal') {
                $row->insentif = $insentifSales;
                $row->insentif_label = format_idr($row->insentif);
            } else {
                $row->insentif_label = 'Data Insentif Belum Ada';
            }

            $totalEstimasi = $conn->table($tbWarga)
                ->where('level', 'Pelanggan')
                ->where('status', '1')
                ->where('id_lokasi', $idLokasi)
                ->where('tgl_registrasi', '<', $tglskg)
                ->sum('harga');
            $row->total_estimasi = (float) $totalEstimasi;
            $summary['total_estimasi'] += $row->total_estimasi;

            $summary['total_pelanggan'] += $row->jumlahpelanggan;
            $cabang[] = $row;
        }

        $summary['balance'] = $summary['total_pemasukan'] - $summary['total_pengeluaran'];

        return [
            'cabang' => $cabang,
            'summary' => $summary,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'tglbulanini' => $tglbulanini,
            'tglskg' => $tglskg,
        ];
    }

    private function getBelumBayarPerLokasi($conn, string $tbWarga, string $tbIuran, string $account, string $tglskg, $idLokasi): int
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
            ->where('a.id_lokasi', $idLokasi)
            ->count();

        return (int) $result;
    }
}
