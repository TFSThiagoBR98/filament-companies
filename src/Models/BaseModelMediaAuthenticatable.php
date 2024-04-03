<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail as HasVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laragear\TwoFactor\Contracts\TwoFactorAuthenticatable;
use Laragear\TwoFactor\TwoFactorAuthentication;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use TFSThiagoBR98\FilamentTenant\HasCompanies;
use TFSThiagoBR98\FilamentTenant\HasConnectedAccounts;
use TFSThiagoBR98\FilamentTenant\HasProfilePhoto;
use TFSThiagoBR98\FilamentTenant\SetsProfilePhotoFromUrl;

/**
 * BaseModelMediaAuthenticable
 * BaseModelMedia with Authenticable assets
 */
abstract class BaseModelMediaAuthenticatable extends BaseModelMedia implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    FilamentUser,
    HasAvatar,
    HasDefaultTenant,
    HasTenants,
    TwoFactorAuthenticatable,
    MustVerifyEmail
{
    use Authenticatable;
    use HasApiTokens;
    use Authorizable;
    use HasCompanies;
    use HasConnectedAccounts;
    use HasProfilePhoto;
    use CanResetPassword;
    use HasVerifyEmail;
    use HasRoles;
    use HasVerifyEmail;
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use AuthenticationLoggable;
    use TwoFactorAuthentication;

    public function canImpersonate()
    {
        return $this->can('impersonate', \App\Models\User::class) || $this->hasRole('super_admin');
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasPermissionTo('access_panel.'.$panel::class) || $this->hasRole('super_admin');
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->belongsToCompany($tenant);
    }

    public function getTenants(Panel $panel): array | Collection
    {
        return $this->allCompanies();
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->currentCompany;
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->profile_photo_url;
    }
}
