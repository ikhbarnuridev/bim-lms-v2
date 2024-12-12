<?php

namespace Tests\Feature\Models;

use Database\Factories\ChapterFactory;
use Database\Factories\CourseFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('courses', [
                'id',
                'title',
                'slug',
                'order',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_has_many_chapters()
    {
        $course = CourseFactory::new()->create();

        for ($i = 0; $i < 5; $i++) {
            ChapterFactory::new()->create([
                'course_id' => $course->id,
            ]);
        }

        $this->assertCount(5, $course->chapters);
    }
}
