<?php

namespace App\TenantTask;

use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

/**
 * EmailTask
 */
class EmailTask implements SwitchTenantTask
{

    /**
     * makeCurrent
     *
     * @param  mixed $tenant
     * @return void
     */
    public function makeCurrent(Tenant $tenant): void {
        $this->setTenantEmail($tenant);
    }

    /**
     * forgetCurrent
     *
     * @return void
     */
    public function forgetCurrent(): void {
        $this->setTenantEmail();
    }

    /**
     * setTenantEmail
     *
     * @param  mixed $tenant
     * @return void
     */
    protected function setTenantEmail(Tenant $tenant = null): void {
        config()->set('mail.mailers.smtp.transport', $tenant->mail->transport);
        config()->set('mail.mailers.smtp.host', $tenant->mail->host);
        config()->set('mail.mailers.smtp.port', $tenant->mail->port);
        config()->set('mail.mailers.smtp.encryption', $tenant->mail->encryption);
        config()->set('mail.mailers.smtp.username', $tenant->mail->username);
        config()->set('mail.mailers.smtp.password', $tenant->mail->password);
        config()->set('mail.from.address', $tenant->mail->username);
        config()->set('mail.from.name', $tenant->name);
    }
}
