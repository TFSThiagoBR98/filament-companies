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
     * The table associated with the model.
     */
    final public const TABLE = 'company_invitations';

    /**
     * Table ID for foreign keys
     */
    final public const FOREIGN_KEY = 'company_invitation_id';

    /**
     * Primary Key
     */
    final public const ATTRIBUTE_ID = 'id';

    final public const ATTRIBUTE_EMAIL = 'email';
    final public const ATTRIBUTE_ROLE = 'role';

    final public const ATTRIBUTE_FK_COMPANY_ID = Company::FOREIGN_KEY;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_ROLE,
        self::ATTRIBUTE_FK_COMPANY_ID,
    ];

    /**
     * Get the company that the invitation belongs to.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::companyModel());
    }
}
