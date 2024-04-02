<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Tenancy;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\DatabaseManager as BaseDatabaseManager;

/**
 * This database manager only create the tenant connection to Database
 */
class ExplicitDatabaseManager extends BaseDatabaseManager
{
    /**
     * Connect to a tenant's database.
     */
    public function connectToTenant(TenantWithDatabase $tenant)
    {
        $this->purgeTenantConnection();
        $this->createTenantConnection($tenant);
    }
}
