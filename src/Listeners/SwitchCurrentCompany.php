<?php

namespace TFSThiagoBR98\FilamentTenant\Listeners;

use Filament\Events\TenantSet;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;
use TFSThiagoBR98\FilamentTenant\HasCompanies;

class SwitchCurrentCompany
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantSet $event): void
    {
        $tenant = $event->getTenant();

        /** @var HasCompanies $user */
        $user = $event->getUser();

        if (FilamentCompanies::switchesCurrentCompany() === false || ! in_array(HasCompanies::class, class_uses_recursive($user), true)) {
            return;
        }

        if (! $user->switchCompany($tenant)) {
            $user->switchCompany($user->personalCompany());
        }
    }
}
