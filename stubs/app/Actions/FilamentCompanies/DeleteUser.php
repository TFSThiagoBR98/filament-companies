<?php

namespace App\Actions\FilamentCompanies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;
use TFSThiagoBR98\FilamentTenant\Contracts\DeletesCompanies;
use TFSThiagoBR98\FilamentTenant\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Create a new action instance.
     */
    public function __construct(protected DeletesCompanies $deletesCompanies)
    {
        //
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteCompanies($user);
            $user->deleteProfilePhoto();
            $user->tokens->each(static fn (Token $token) => $token->delete());
            $user->delete();
        });
    }

    /**
     * Delete the companies and company associations attached to the user.
     */
    protected function deleteCompanies(User $user): void
    {
        $user->companies()->detach();

        $user->ownedCompanies->each(function (Company $company) {
            $this->deletesCompanies->delete($company);
        });
    }
}
