<?php

namespace App\TenantTask;

use Illuminate\Support\Facades\Config;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

/**
 * FileSystemTask
 */
class FileSystemTask implements SwitchTenantTask
{

    /**
     * makeCurrent
     *
     * @param  mixed $tenant
     * @return void
     */
    public function makeCurrent(Tenant $tenant): void {
        $this->setTenantFileSystem($tenant->name);
    }

    /**
     * forgetCurrent
     *
     * @return void
     */
    public function forgetCurrent(): void {
        $this->setTenantFileSystem();
    }

    /**
     * setTenantFilesystem
     *
     * @param  mixed $tenant
     * @return void
     */
    protected function setTenantFileSystem($name = null): void {
        config()->set('filesystems.disks.tenant_system.root', storage_path("app/{$name}"));
        //app('filesystem')->forgetDriver(config('filesystems.default'));
    }
}
