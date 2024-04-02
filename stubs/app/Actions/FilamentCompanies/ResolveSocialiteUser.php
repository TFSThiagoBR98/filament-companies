<?php

namespace App\Actions\FilamentCompanies;

use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use TFSThiagoBR98\FilamentTenant\Contracts\ResolvesSocialiteUsers;
use TFSThiagoBR98\FilamentTenant\Enums\Feature;

class ResolveSocialiteUser implements ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     */
    public function resolve(string $provider): User
    {
        $user = Socialite::driver($provider)->user();

        if (Feature::GenerateMissingEmails->isEnabled()) {
            $user->email = $user->getEmail() ?? ("{$user->id}@{$provider}" . config('app.domain'));
        }

        return $user;
    }
}
