<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CompanyPolicy extends BasePolicy
{
    /**
     * @var string
     */
    protected string $model = Company::class;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user, ?Model $model = null, ?array $injectedArgs = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ?Model $model = null, ?array $injectedArgs = null): bool
    {
        return $user->belongsToCompany($model);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user, ?array $injectedArgs = null, ?Model $model = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, ?Model $model = null, ?array $injectedArgs = null): bool
    {
        return $user->ownsCompany($model);
    }

    /**
     * Determine whether the user can add company employees.
     */
    public function addCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }

    /**
     * Determine whether the user can update company employee permissions.
     */
    public function updateCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }

    /**
     * Determine whether the user can remove company employees.
     */
    public function removeCompanyEmployee(User $user, Company $company): bool
    {
        return $user->ownsCompany($company);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?Model $model = null, ?array $injectedArgs = null): bool
    {
        return $user->ownsCompany($model);
    }
}
