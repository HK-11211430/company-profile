<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Galeri;

$items = Galeri::take(100)->get();
$count = Galeri::count();
echo "galeris count: {$count}" . PHP_EOL;
if ($count === 0) {
    exit(0);
}

foreach ($items as $row) {
    echo $row->id . '|' . $row->gambar . PHP_EOL;
}
