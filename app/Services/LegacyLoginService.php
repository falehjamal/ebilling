<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LegacyLoginService
{
    public function __construct(
        protected TenantConnectionService $tenantConnection
    ) {}

    /**
     * @return array{user: array, tenant: array}|false
     */
    public function attempt(string $account, string $username, string $password): array|false
    {
        $tenantConfig = $this->tenantConnection->getTenantConfig($account);

        if (! $tenantConfig) {
            return false;
        }

        $this->tenantConnection->createTenantConnection($tenantConfig);

        $tableName = 'tb_warga_'.$account;

        if (! $this->tableExists($tableName)) {
            return false;
        }

        $warga = DB::connection('tenant')
            ->table($tableName)
            ->where('username', $username)
            ->where('password', $password)
            ->where('account', $account)
            ->where('status', '1')
            ->first();

        if (! $warga) {
            return false;
        }

        $userData = (array) $warga;

        $tbUser = DB::connection('tenant')
            ->table('tb_user')
            ->where('account', $account)
            ->first();

        $expiredUser = $tbUser?->expired_user ?? null;
        $tlpUser = $tbUser?->tlp_user ?? null;

        $today = now()->format('Y-m-d');
        if ($expiredUser && $today > $expiredUser) {
            return false;
        }

        $userData['expired_user'] = $expiredUser;
        $userData['tlp_user'] = $tlpUser;

        return [
            'user' => $userData,
            'tenant' => $tenantConfig,
        ];
    }

    public function logLogin(array $userData): void
    {
        if (! $this->tableExists('tb_log')) {
            return;
        }

        $ip = request()->ip();

        DB::connection('tenant')->table('tb_log')->insert([
            'account' => $userData['account'] ?? null,
            'nama_log' => "Login e-Billing System dari {$ip}",
            'id_warga' => $userData['id_warga'] ?? null,
            'nama_warga' => $userData['nama_warga'] ?? null,
        ]);
    }

    protected function tableExists(string $table): bool
    {
        return DB::connection('tenant')
            ->getSchemaBuilder()
            ->hasTable($table);
    }
}
