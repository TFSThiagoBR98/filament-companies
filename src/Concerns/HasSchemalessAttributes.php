<?php

declare(strict_types=1);

namespace TFSThiagoBR98\FilamentTenant\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * Schemaless Data
 *
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes $extra_attributes
 */
trait HasSchemalessAttributes
{
    use SchemalessAttributesTrait;

    public function initializeHasSchemalessAttributes(): void
    {
        $this->casts['extra_attributes'] = SchemalessAttributes::class;
    }

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra_attributes->modelScope();
    }
}
