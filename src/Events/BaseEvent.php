<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Events;

use TFSThiagoBR98\FilamentTenant\Models\BaseModel;

/**
 * Class BaseEvent.
 *
 * @template TModel of BaseModel
 */
abstract class BaseEvent
{
    /**
     * Create a new event instance.
     *
     * @param  TModel|BaseModel  $model
     */
    public function __construct(protected BaseModel $model)
    {
    }

    /**
     * Get the model that has fired this event.
     *
     * @return TModel|BaseModel
     */
    abstract public function getModel(): BaseModel;
}
