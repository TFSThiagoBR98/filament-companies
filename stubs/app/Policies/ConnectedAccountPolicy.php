<?php

namespace App\Policies;

use App\Models\ConnectedAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ConnectedAccountPolicy extends BasePolicy
{
    /**
     * @var string
     */
    protected string $model = ConnectedAccount::class;

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
        return $user->ownsConnectedAccount($model);
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
        return $user->ownsConnectedAccount($model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, ?Model $model = null, ?array $injectedArgs = null): bool
    {
        return $user->ownsConnectedAccount($model);
    }
}
