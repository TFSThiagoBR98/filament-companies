<?php

namespace TFSThiagoBR98\FilamentTenant\Contracts;

use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface CreatesNewUsers
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User|Authenticatable;
}
