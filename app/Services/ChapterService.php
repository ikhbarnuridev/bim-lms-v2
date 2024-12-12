<?php

namespace App\Services;

use App\Models\Chapter;

class ChapterService
{
    public function getNextOrder(): int
    {
        $maxOrder = Chapter::max('order');

        return $maxOrder ? $maxOrder + 1 : 1;
    }
}
