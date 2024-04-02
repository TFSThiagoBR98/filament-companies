<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\CentralConnection;
use TFSThiagoBR98\FilamentTenant\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;

class CompanyInvitation extends BaseModel
{
    use CentralConnection;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the company that the invitation belongs to.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::companyModel());
    }
}
