<?php

namespace App\TenantTask;

use App\Models\CustomTenant;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

/**
 * LogTask
 */
class LogTask implements SwitchTenantTask
{

    /**
     * makeCurrent
     *
     * @param  mixed $tenant
     * @return void
     */
    public function makeCurrent(Tenant $tenant): void {
        $this->setTenantLog($tenant);
    }

    /**
     * forgetCurrent
     *
     * @return void
     */
    public function forgetCurrent(): void {
        $this->setTenantLog();
    }

    /**
     * setTenantLog
     *
     * @param  mixed $tenant
     * @return void
     */
    protected function setTenantLog(CustomTenant $tenant = null): void {
        config()->set('logging.channels.tenant_log.path', storage_path("logs/{$tenant->name}.log"));
    }
}
