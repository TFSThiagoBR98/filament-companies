<?php

namespace TFSThiagoBR98\FilamentTenant\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CompanyEmployeeRemoved
{
    use Dispatchable;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The company employee that was removed.
     */
    public mixed $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $company, mixed $user)
    {
        $this->company = $company;
        $this->user = $user;
    }
}
