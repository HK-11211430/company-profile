<?php

return [
    'galeri' => [
        'target' => env('FILAMENT_GALERI_TARGET', 50),
        'color_from' => 'indigo-500',
        'color_to' => 'indigo-700',
        'badge_bg' => 'indigo-50',
        'badge_text' => 'indigo-700',
        'icon' => 'camera',
        'resource' => 'galeris',
    ],

    'artikel' => [
        'target' => env('FILAMENT_ARTIKEL_TARGET', 20),
        'color_from' => 'emerald-500',
        'color_to' => 'emerald-700',
        'badge_bg' => 'emerald-50',
        'badge_text' => 'emerald-700',
        'icon' => 'document',
        'resource' => 'artikels',
    ],

    'overview' => [
        'enabled' => true,
    ],
];
