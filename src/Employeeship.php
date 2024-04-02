<?php

namespace TFSThiagoBR98\FilamentTenant;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

abstract class Employeeship extends Pivot
{
    use CentralConnection;

    /**
     * The table associated with the pivot model.
     *
     * @var string
     */
    protected $table = 'company_user';
}
