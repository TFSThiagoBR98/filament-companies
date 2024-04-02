<?php

namespace App\Actions\FilamentCompanies;

use Illuminate\Http\Response;
use Laravel\Socialite\Two\InvalidStateException;
use TFSThiagoBR98\FilamentTenant\Contracts\HandlesInvalidState;

class HandleInvalidState implements HandlesInvalidState
{
    /**
     * Handle an invalid state exception from a Socialite provider.
     */
    public function handle(InvalidStateException $exception, ?callable $callback = null): Response
    {
        if ($callback) {
            return $callback($exception);
        }

        throw $exception;
    }
}
