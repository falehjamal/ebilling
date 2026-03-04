<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $service): View|RedirectResponse
    {
        $account = billing_user('account');

        if (! $account) {
            return redirect()->route('login');
        }

        $stats = $service->getStats($account);

        return view('dashboard', $stats);
    }
}
