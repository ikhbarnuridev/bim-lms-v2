<?php

namespace App\Services;

use App\Models\Material;

class MaterialService
{
    public function getNextOrder(): int
    {
        $maxOrder = Material::query()->max('order');

        return $maxOrder ? $maxOrder + 1 : 1;
    }
}
