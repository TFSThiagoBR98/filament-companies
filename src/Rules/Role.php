<?php

namespace TFSThiagoBR98\FilamentTenant\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Guard;
use TFSThiagoBR98\FilamentTenant\Models\Role as ModelRole;

class Role implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        $guardName = Guard::getDefaultName(static::class);
        $role = ModelRole::findByParam(['name' => $value, 'guard_name' => $guardName]);
        return $role == null;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return __('filament-companies::default.errors.valid_role');
    }
}
