<?php

namespace App\Http\Middleware;

use App\Services\TenantConnectionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantConnection
{
    public function __construct(
        protected TenantConnectionService $tenantConnection
    ) {}

    /**
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenantConfig = session('billing.tenant');
        if ($tenantConfig) {
            $this->tenantConnection->createTenantConnection($tenantConfig);
        }

        return $next($request);
    }
}
