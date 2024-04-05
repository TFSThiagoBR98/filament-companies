<?php

namespace TFSThiagoBR98\FilamentTenant;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

abstract class Employeeship extends Pivot
{
    use CentralConnection;
    use HasRoles;

    /**
     * The table associated with the pivot model.
     *
     * @var string
     */
    protected $table = 'company_user';
}
