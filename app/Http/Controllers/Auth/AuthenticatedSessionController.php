<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LegacyLoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function __construct(
        protected LegacyLoginService $loginService
    ) {}

    public function create(): View|RedirectResponse
    {
        if (session()->has('billing.user')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $result = $this->loginService->attempt(
            $request->validated('account'),
            $request->validated('username'),
            $request->validated('password')
        );

        if ($result === false) {
            return back()->withErrors(['login' => 'Login gagal. Periksa account, username, dan password.']);
        }

        session([
            'billing.tenant' => $result['tenant'],
            'billing.user' => $result['user'],
        ]);

        $this->loginService->logLogin($result['user']);

        $redirectUrl = config("billing.account_redirects.{$result['user']['account']}")
            ?? config('billing.default_redirect');

        if (filter_var($redirectUrl, FILTER_VALIDATE_URL)) {
            return redirect()->away($redirectUrl);
        }

        return redirect()->intended($redirectUrl);
    }

    public function destroy(): RedirectResponse
    {
        session()->forget(['billing.user', 'billing.tenant']);

        return redirect()->route('login');
    }
}
