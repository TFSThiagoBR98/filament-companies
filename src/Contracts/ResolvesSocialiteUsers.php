<?php

namespace TFSThiagoBR98\FilamentTenant\Contracts;

use Laravel\Socialite\Contracts\User;

interface ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     */
    public function resolve(string $provider): User;
}
