<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use Database\Factories\ChapterFactory;
use Database\Factories\MaterialFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ChapterTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('chapters', [
                'id',
                'title',
                'slug',
                'order',
                'course_id',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_belongs_to_course()
    {
        $chapter = ChapterFactory::new()->create();

        $this->assertInstanceOf(Course::class, $chapter->course);
    }

    public function test_relation_has_many_materials()
    {
        $chapter = ChapterFactory::new()->create();

        for ($i = 0; $i < 5; $i++) {
            MaterialFactory::new()->create([
                'chapter_id' => $chapter->id,
            ]);
        }

        $this->assertCount(5, $chapter->materials);
    }
}
