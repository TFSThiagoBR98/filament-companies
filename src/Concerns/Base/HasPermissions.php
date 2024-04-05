<?php

namespace TFSThiagoBR98\FilamentTenant\Concerns\Base;

use Spatie\Permission\Guard;
use TFSThiagoBR98\FilamentTenant\Models\Permission;
use TFSThiagoBR98\FilamentTenant\Models\Role;

trait HasPermissions
{
    /**
     * The roles that are available to assign to users.
     */
    public static array $roles = [];

    /**
     * The permissions that exist within the application.
     */
    public static array $permissions = [];

    /**
     * The default permissions that should be available to new entities.
     */
    public static array $defaultPermissions = [];

    /**
     * Determine if Company has registered roles.
     */
    public static function hasRoles(): bool
    {
        return Role::count() > 0;
    }

    /**
     * Find the role with the given key.
     */
    public static function findRole(string $key): ?Role
    {
        $guardName = Guard::getDefaultName(static::class);
        return Role::findByParam(['name' => $key, 'guard_name' => $guardName]);
    }

    /**
     * Determine if any permissions have been registered with Company.
     */
    public static function hasPermissions(): bool
    {
        return Permission::count() > 0;
    }

    /**
     * Define the available API token permissions.
     */
    public static function permissions(array $permissions): static
    {
        static::$permissions = $permissions;

        return new static;
    }

    /**
     * Define the default permissions that should be available to new API tokens.
     */
    public static function defaultApiTokenPermissions(array $permissions): static
    {
        static::$defaultPermissions = $permissions;

        return new static;
    }

    /**
     * Return the permissions in the given list that are actually defined permissions for the application.
     */
    public static function validPermissions(array $permissions): array
    {
        return array_values(array_intersect($permissions, static::$permissions));
    }
}
