<?php

namespace TFSThiagoBR98\FilamentTenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use TFSThiagoBR98\FilamentTenant\Models\BaseModelMedia;

/**
 * @property string $id
 * @property string $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string $token
 * @property string|null $secret
 * @property string|null $refresh_token
 * @property Carbon|null $expires_at
 */
abstract class ConnectedAccount extends BaseModelMedia
{
    use CentralConnection;

    /**
     * Get the credentials used for authenticating services.
     */
    public function getCredentials(): Credentials
    {
        return new Credentials($this);
    }

    /**
     * Get user of the connected account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::userModel(), 'user_id', FilamentCompanies::newUserModel()->getAuthIdentifierName());
    }

    /**
     * Get the data that should be shared.
     *
     * @return array<string, mixed>
     */
    public function getSharedData(): array
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
            'avatar_path' => $this->avatar_path,
            'created_at' => $this->created_at?->diffForHumans(),
        ];
    }
}
