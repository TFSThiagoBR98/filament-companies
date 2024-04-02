<?php

namespace TFSThiagoBR98\FilamentTenant\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use TFSThiagoBR98\FilamentTenant\Events\CompanyEmployeeUpdated;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;
use TFSThiagoBR98\FilamentTenant\Rules\Role;

class UpdateCompanyEmployeeRole
{
    /**
     * Update the role for the given company employee.
     *
     * @throws AuthorizationException
     */
    public function update(mixed $user, mixed $company, int $companyEmployeeId, string $role): void
    {
        Gate::forUser($user)->authorize('updateCompanyEmployee', $company);

        Validator::make(compact('role'), [
            'role' => ['required', 'string', new Role],
        ])->validate();

        $company->users()->updateExistingPivot($companyEmployeeId, compact('role'));

        CompanyEmployeeUpdated::dispatch($company->fresh(), FilamentCompanies::findUserByIdOrFail($companyEmployeeId));
    }
}
