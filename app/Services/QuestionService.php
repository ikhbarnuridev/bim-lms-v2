<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\Question;

class QuestionService
{
    public function getNextOrder(Exam $exam): int
    {
        $maxOrder = Question::query()
            ->where('exam_id', $exam->id)
            ->max('order');

        return $maxOrder ? $maxOrder + 1 : 1;
    }
}
