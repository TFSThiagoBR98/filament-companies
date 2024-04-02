<?php

namespace TFSThiagoBR98\FilamentTenant\Rules;

use Illuminate\Contracts\Validation\Rule;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;

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
        return array_key_exists($value, FilamentCompanies::$roles);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return __('filament-companies::default.errors.valid_role');
    }
}
