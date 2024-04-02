<?php

namespace App\Actions\FilamentCompanies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as ProviderUserContract;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesConnectedAccounts;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesUserFromProvider;
use TFSThiagoBR98\FilamentTenant\Enums\Feature;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;

class CreateUserFromProvider implements CreatesUserFromProvider
{
    /**
     * The creates connected accounts instance.
     */
    public CreatesConnectedAccounts $createsConnectedAccounts;

    /**
     * Create a new action instance.
     */
    public function __construct(CreatesConnectedAccounts $createsConnectedAccounts)
    {
        $this->createsConnectedAccounts = $createsConnectedAccounts;
    }

    /**
     * Create a new user from a social provider user.
     */
    public function create(string $provider, ProviderUserContract $providerUser): User
    {
        return DB::transaction(function () use ($providerUser, $provider) {
            return tap(User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]), function (User $user) use ($providerUser, $provider) {
                $user->markEmailAsVerified();

                if ($this->shouldSetProfilePhoto($providerUser)) {
                    $user->setProfilePhotoFromUrl($providerUser->getAvatar());
                }

                $user->switchConnectedAccount(
                    $this->createsConnectedAccounts->create($user, $provider, $providerUser)
                );

                $this->createCompany($user);
            });
        });
    }

    private function shouldSetProfilePhoto(ProviderUserContract $providerUser): bool
    {
        return Feature::ProviderAvatars->isEnabled() &&
            FilamentCompanies::managesProfilePhotos() &&
            $providerUser->getAvatar();
    }

    /**
     * Create a personal company for the user.
     */
    protected function createCompany(User $user): void
    {
        $user->ownedCompanies()->save(Company::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Company",
            'personal_company' => true,
        ]));
    }
}
