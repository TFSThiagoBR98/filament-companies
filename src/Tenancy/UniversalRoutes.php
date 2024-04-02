<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Tenancy;

use Stancl\Tenancy\Features\UniversalRoutes as Feature;
use Stancl\Tenancy\Middleware;

class UniversalRoutes extends Feature
{
    public static $identificationMiddlewares = [
        Middleware\InitializeTenancyByDomain::class,
        Middleware\InitializeTenancyBySubdomain::class,
        Middleware\InitializeTenancyByRequestData::class,
    ];
}
