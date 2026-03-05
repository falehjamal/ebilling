<?php

namespace App\Http\Controllers;

use App\Services\DashboardCabangService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardCabangController extends Controller
{
    public function __invoke(DashboardCabangService $service): View|RedirectResponse
    {
        $account = billing_user('account');

        if (! $account) {
            return redirect()->route('login');
        }

        $tgl = request('tgl');
        if ($tgl) {
            if (preg_match('/^\d{4}-\d{2}$/', $tgl)) {
                $tgl = $tgl.'-01';
            } elseif (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl)) {
                $tgl = null;
            }
        }

        $data = $service->getData($account, $tgl ?: null);

        return view('dashboard-cabang', array_merge($data, [
            'legacyBaseUrl' => rtrim(config('billing.legacy_base_url'), '/'),
            'account' => $account,
        ]));
    }
}
