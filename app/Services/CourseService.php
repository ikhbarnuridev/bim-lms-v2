<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function getNextOrder(): int
    {
        $maxOrder = Course::max('order');

        return $maxOrder ? $maxOrder + 1 : 1;
    }
}
