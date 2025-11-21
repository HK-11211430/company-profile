<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurusanResource;

/**
 * Compatibility stub for the old ProdukResource.
 *
 * This class intentionally extends the new `JurusanResource` and
 * disables its own navigation label to avoid duplicate admin menu
 * entries while preserving any autoloaded class references.
 */
class ProdukResource extends JurusanResource
{
    protected static ?string $navigationLabel = null;
}
