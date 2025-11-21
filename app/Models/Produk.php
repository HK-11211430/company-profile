<?php

namespace App\Models;

/**
 * Legacy alias model.
 * Keeping this class as a thin compatibility shim so existing code that
 * references App\Models\Produk continues to work after renaming to Jurusan.
 */
class Produk extends Jurusan
{
    // No additional logic — inherits everything from Jurusan.
}
