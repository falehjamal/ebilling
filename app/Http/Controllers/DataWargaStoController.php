<?php

namespace App\Http\Controllers;

use App\Services\DataWargaStoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataWargaStoController extends Controller
{
    public function __invoke(Request $request, DataWargaStoService $service): View|RedirectResponse
    {
        $account = billing_user('account');

        if (! $account) {
            return redirect()->route('login');
        }

        $encoded = $request->query('id_lokasi');
        if (! $encoded) {
            return redirect()->route('dashboard-cabang')
                ->with('error', 'Parameter id_lokasi tidak valid.');
        }

        $idLokasi = $service->decodeIdLokasi($encoded);
        if ($idLokasi === null) {
            return redirect()->route('dashboard-cabang')
                ->with('error', 'Parameter id_lokasi tidak valid.');
        }

        $data = $service->getData($account, $idLokasi);

        return view('data-warga-sto', $data);
    }
}
