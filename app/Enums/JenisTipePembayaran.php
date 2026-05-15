<?php

namespace App\Enums;

enum JenisTipePembayaran: string
{
    case WajibTiapBulan = 'Wajib Tiap Bulan';

    case TidakWajibTiapBulan = 'Tidak Wajib Tiap Bulan';
}
