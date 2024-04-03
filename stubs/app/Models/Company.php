<?php

namespace App\Models;

use TFSThiagoBR98\FilamentTenant\Company as FilamentCompaniesCompany;
use TFSThiagoBR98\FilamentTenant\Enums\GenericStatus;

class Company extends FilamentCompaniesCompany
{
    /**
     * The table associated with the model.
     */
    final public const TABLE = 'companies';

    /**
     * Table ID for foreign keys
     */
    final public const FOREIGN_KEY = 'company_id';

    /**
     * Primary Key
     */
    final public const ATTRIBUTE_ID = 'id';

    final public const ATTRIBUTE_SLUG = 'slug';
    final public const ATTRIBUTE_NAME = 'name';
    final public const ATTRIBUTE_TAX_ID = 'tax_id';
    final public const ATTRIBUTE_TENANCY_DB_NAME = 'tenancy_db_name';
    final public const ATTRIBUTE_VISIBLE_TO_CLIENT = 'visible_to_client';
    final public const ATTRIBUTE_PERSONAL_COMPANY = 'personal_company';
    final public const ATTRIBUTE_STATUS = 'status';

    final public const ATTRIBUTE_FK_USER_ID = User::FOREIGN_KEY;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_SLUG,
        self::ATTRIBUTE_TAX_ID,
        self::ATTRIBUTE_TENANCY_DB_NAME,
        self::ATTRIBUTE_VISIBLE_TO_CLIENT,
        self::ATTRIBUTE_PERSONAL_COMPANY,
        self::ATTRIBUTE_STATUS,
        self::ATTRIBUTE_FK_USER_ID,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::ATTRIBUTE_NAME => 'string',
            self::ATTRIBUTE_SLUG => 'string',
            self::ATTRIBUTE_TAX_ID => 'string',
            self::ATTRIBUTE_TENANCY_DB_NAME => 'string',
            self::ATTRIBUTE_VISIBLE_TO_CLIENT => 'boolean',
            self::ATTRIBUTE_PERSONAL_COMPANY => 'boolean',
            self::ATTRIBUTE_STATUS => GenericStatus::class,
        ];
    }
}
