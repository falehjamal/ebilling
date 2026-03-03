<?php

namespace App\Services;

use App\Models\BillingAccount;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantConnectionService
{
    public function getTenantConfig(string $account): ?array
    {
        $billingAccount = BillingAccount::on('gateway')
            ->where('account', $account)
            ->whereNotNull('ip')
            ->whereNotNull('nama_db')
            ->first();

        if ($billingAccount) {
            [$host, $port] = $this->resolveHostPort($billingAccount->ip ?? '127.0.0.1:3306');

            return [
                'host' => $host,
                'port' => $port,
                'database' => $billingAccount->nama_db ?? config('database.connections.mysql.database'),
                'username' => $billingAccount->username ?? config('database.connections.mysql.username'),
                'password' => $billingAccount->password ?? config('database.connections.mysql.password'),
            ];
        }

        $fallback = config('database.connections.fallback_client');

        return [
            'host' => $fallback['host'],
            'port' => $fallback['port'],
            'database' => $fallback['database'],
            'username' => $fallback['username'],
            'password' => $fallback['password'],
        ];
    }

    public function createTenantConnection(array $config): \Illuminate\Database\Connection
    {
        $config = array_merge(config('database.connections.mysql'), [
            'host' => $config['host'],
            'port' => $config['port'],
            'database' => $config['database'],
            'username' => $config['username'],
            'password' => $config['password'],
        ]);

        Config::set('database.connections.tenant', $config);
        DB::purge('tenant');

        return DB::connection('tenant');
    }

    /**
     * @return array{0: string, 1: string}
     */
    public function resolveHostPort(string $ip): array
    {
        if (str_contains($ip, ':')) {
            $parts = explode(':', $ip, 2);

            return [$parts[0], $parts[1]];
        }

        return [$ip, '3306'];
    }
}
