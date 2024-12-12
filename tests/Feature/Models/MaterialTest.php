<?php

namespace Tests\Feature\Models;

use App\Models\Chapter;
use Database\Factories\MaterialFactory;
use Database\Factories\MaterialStatusFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('materials', [
                'id',
                'title',
                'slug',
                'content',
                'order',
                'chapter_id',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_belongs_to_chapter()
    {
        $material = MaterialFactory::new()->create();

        $this->assertInstanceOf(Chapter::class, $material->chapter);
    }

    public function test_relation_has_many_material_statuses()
    {
        $material = MaterialFactory::new()->create();

        MaterialStatusFactory::new()->count(5)->create([
            'material_id' => $material->id,
        ]);

        $this->assertCount(5, $material->materialStatuses);
    }
}
