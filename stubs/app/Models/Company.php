<?php

namespace App\Models;

use TFSThiagoBR98\FilamentTenant\Company as FilamentCompaniesCompany;

class Company extends FilamentCompaniesCompany
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'tenancy_db_name',
        'personal_company',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_company' => 'boolean',
        ];
    }
}
