<?php

namespace Tests\Feature\Models;

use App\Models\Student;
use Database\Factories\StudentFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id',
                'name',
                'username',
                'password',
                'remember_token',
                'created_at',
                'updated_at',
                'deleted_at',
                'created_by',
                'updated_by',
                'deleted_by',
            ])
        );
    }

    public function test_relation_has_one_student()
    {
        $user = UserFactory::new()->create();

        StudentFactory::new()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(Student::class, $user->student);
    }
}
