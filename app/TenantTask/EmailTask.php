<?php

namespace App\TenantTask;

use App\Models\CustomTenant;
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
    protected function setTenantEmail(CustomTenant $tenant = null): void {
        config()->set('mail.mailers.smtp.transport', (!$tenant->mail) ? env('MAIL_MAILER') : $tenant->mail->transport);
        config()->set('mail.mailers.smtp.host', (!$tenant->mail) ? env('MAIL_HOST') : $tenant->mail->host);
        config()->set('mail.mailers.smtp.port', (!$tenant->mail) ? env('MAIL_PORT') : $tenant->mail->port);
        config()->set('mail.mailers.smtp.encryption', (!$tenant->mail) ? env('MAIL_ENCRYPTION') : $tenant->mail->encryption);
        config()->set('mail.mailers.smtp.username', (!$tenant->mail) ? env('MAIL_USERNAME') : $tenant->mail->username);
        config()->set('mail.mailers.smtp.password', (!$tenant->mail) ? env('MAIL_PASSWORD') : $tenant->mail->password);
        config()->set('mail.from.address', (!$tenant->mail) ? env('MAIL_FROM_ADDRESS') : $tenant->mail->username);
        config()->set('mail.from.name', (!$tenant->mail) ? env('MAIL_FROM_NAME') : $tenant->name);
    }
}
