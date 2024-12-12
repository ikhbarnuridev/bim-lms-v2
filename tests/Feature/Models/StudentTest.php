<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Database\Factories\MaterialStatusFactory;
use Database\Factories\StudentFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class StudentTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('students', [
                'id',
                'nis',
                'user_id',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_belongs_to_user()
    {
        $student = StudentFactory::new()->create();

        $this->assertInstanceOf(User::class, $student->user);
    }

    public function test_relation_has_many_material_statuses()
    {
        $student = StudentFactory::new()->create();

        MaterialStatusFactory::new()->count(5)->create([
            'student_id' => $student->id,
        ]);

        $this->assertCount(5, $student->materialStatuses);
    }
}
