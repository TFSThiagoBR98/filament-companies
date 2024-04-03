<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Events\Base;

use TFSThiagoBR98\FilamentTenant\Events\BaseEvent;
use Illuminate\Foundation\Events\Dispatchable;
use TFSThiagoBR98\FilamentTenant\Models\BaseModel;

/**
 * Class BaseCreatedEvent.
 *
 * @template TModel of BaseModel
 * @extends BaseEvent<TModel>
 */
abstract class BaseCreatedEvent extends BaseEvent
{
    use Dispatchable;
}
