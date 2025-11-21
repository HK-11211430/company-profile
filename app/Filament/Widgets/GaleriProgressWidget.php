<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Galeri;

class GaleriProgressWidget extends Widget
{
    protected static string $view = 'filament.widgets.galeri-progress-widget';

    public int $total = 0;

    public function mount(): void
    {
        $this->total = Galeri::count();
    }
}
