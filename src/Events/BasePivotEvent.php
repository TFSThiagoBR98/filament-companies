<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Events;

use TFSThiagoBR98\FilamentTenant\Models\BaseModel;

/**
 * Class BasePivotEvent.
 *
 * @template TModelRelated of BaseModel
 * @template TModelForeign of BaseModel
 */
abstract class BasePivotEvent
{
    /**
     * Create a new event instance.
     *
     * @param  TModelRelated|BaseModel  $related
     * @param  TModelForeign|BaseModel  $foreign
     */
    public function __construct(protected BaseModel $related, protected BaseModel $foreign)
    {
    }

    /**
     * Get the related model.
     *
     * @return TModelRelated|BaseModel
     */
    public function getRelated(): BaseModel
    {
        return $this->related;
    }

    /**
     * Get the foreign model.
     *
     * @return TModelForeign|BaseModel
     */
    public function getForeign(): BaseModel
    {
        return $this->foreign;
    }
}
