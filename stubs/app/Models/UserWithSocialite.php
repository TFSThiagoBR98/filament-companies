<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\CentralConnection;
use TFSThiagoBR98\FilamentTenant\Models\BaseModelMediaAuthenticatable;

class User extends BaseModelMediaAuthenticatable
{
    use CentralConnection;

    /**
     * The table associated with the model.
     */
    final public const TABLE = 'users';

    /**
     * Table ID for foreign keys
     */
    final public const FOREIGN_KEY = 'user_id';

    /**
     * Primary Key
     */
    final public const ATTRIBUTE_ID = 'id';

    final public const ATTRIBUTE_NAME = 'name';
    final public const ATTRIBUTE_TAX_ID = 'tax_number';
    final public const ATTRIBUTE_EMAIL = 'email';
    final public const ATTRIBUTE_PHONE = 'phone';
    final public const ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    final public const ATTRIBUTE_PASSWORD = 'password';
    final public const ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';
    final public const ATTRIBUTE_PROFILE_PHOTO_URL = 'profile_photo_url';

    /**
     * Default Guard for the model
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_TAX_ID,
        self::ATTRIBUTE_PHONE,
        self::ATTRIBUTE_PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        self::ATTRIBUTE_PROFILE_PHOTO_URL,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::ATTRIBUTE_EMAIL_VERIFIED_AT => 'datetime',
            self::ATTRIBUTE_PASSWORD => 'hashed',
        ];
    }
}
