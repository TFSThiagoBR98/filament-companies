<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Events\Base;

use Illuminate\Queue\SerializesModels;
use TFSThiagoBR98\FilamentTenant\Events\BaseEvent;
use Illuminate\Foundation\Events\Dispatchable;
use TFSThiagoBR98\FilamentTenant\Models\BaseModel;

/**
 * Class BaseDeletedEvent.
 *
 * @template TModel of BaseModel
 * @extends BaseEvent<TModel>
 */
abstract class BaseDeletedEvent extends BaseEvent
{
    use Dispatchable;
    use SerializesModels;
}
