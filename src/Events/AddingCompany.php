<?php

namespace TFSThiagoBR98\FilamentTenant\Events;

use Illuminate\Foundation\Events\Dispatchable;

class AddingCompany
{
    use Dispatchable;

    /**
     * The company owner.
     */
    public mixed $owner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $owner)
    {
        $this->owner = $owner;
    }
}
