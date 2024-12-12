<?php

namespace Tests\Feature\Models;

use App\Models\Material;
use App\Models\Student;
use Database\Factories\MaterialStatusFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MaterialStatusTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('material_statuses', [
                'id',
                'is_done',
                'student_id',
                'material_id',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_belongs_to_material()
    {
        $materialStatus = MaterialStatusFactory::new()->create();

        $this->assertInstanceOf(Material::class, $materialStatus->material);
    }

    public function test_relation_belongs_to_student()
    {
        $materialStatus = MaterialStatusFactory::new()->create();

        $this->assertInstanceOf(Student::class, $materialStatus->student);
    }
}
