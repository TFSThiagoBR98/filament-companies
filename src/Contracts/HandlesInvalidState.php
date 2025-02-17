<?php

namespace TFSThiagoBR98\FilamentTenant\Contracts;

use Illuminate\Http\Response;
use Laravel\Socialite\Two\InvalidStateException;

interface HandlesInvalidState
{
    /**
     * Handle an invalid state exception from a Socialite provider.
     */
    public function handle(InvalidStateException $exception, ?callable $callback = null): Response;
}
