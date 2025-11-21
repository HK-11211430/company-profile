<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Artikel;

class ArtikelProgressWidget extends Widget
{
    protected static string $view = 'filament.widgets.artikel-progress-widget';

    public int $total = 0;

    public function mount(): void
    {
        $this->total = Artikel::count();
    }
}
