<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\CentralConnection;
use TFSThiagoBR98\FilamentTenant\ConnectedAccount as SocialiteConnectedAccount;
use TFSThiagoBR98\FilamentTenant\Events\ConnectedAccountCreated;
use TFSThiagoBR98\FilamentTenant\Events\ConnectedAccountDeleted;
use TFSThiagoBR98\FilamentTenant\Events\ConnectedAccountUpdated;

class ConnectedAccount extends SocialiteConnectedAccount
{
    use CentralConnection;

    /**
     * The table associated with the model.
     */
    final public const TABLE = 'connected_accounts';

    /**
     * Table ID for foreign keys
     */
    final public const FOREIGN_KEY = 'connected_account_id';

    /**
     * Primary Key
     */
    final public const ATTRIBUTE_ID = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'name',
        'nickname',
        'email',
        'avatar_path',
        'token',
        'refresh_token',
        'expires_at',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => ConnectedAccountCreated::class,
        'updated' => ConnectedAccountUpdated::class,
        'deleted' => ConnectedAccountDeleted::class,
    ];
}
