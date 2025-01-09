<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Material;

class ContentService
{
    public function getNextOrder(Material $material): int
    {
        $maxOrder = Content::query()
            ->where('material_id', $material->id)
            ->max('order');

        return $maxOrder ? $maxOrder + 1 : 1;
    }
}
