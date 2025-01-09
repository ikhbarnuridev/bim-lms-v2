<?php

namespace Database\Seeders;

use App\Models\MaterialStatus;
use Database\Factories\MaterialFactory;
use Database\Factories\StudentFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin
        $admin = UserFactory::new()->create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        $admin->assignRole('admin');

        // Create students
        $students = StudentFactory::new()->count(60)->create();

        // Create teachers
        $teachers = UserFactory::new()->count(5)->create();
        foreach ($teachers as $teacher) {
            $teacher->assignRole('teacher');
        }

        // Create materials
        $materials = MaterialFactory::new()->createMany([
            [
                'title' => 'Pengertian Fiqih',
                'slug' => 'pengertian-fiqih',
            ],
            [
                'title' => 'Rukun Islam dan Penjelasannya',
                'slug' => 'rukun-islam-dan-penjelasannya',
            ],
            [
                'title' => 'Thaharah: Bersuci dalam Islam',
                'slug' => 'thaharah-bersuci-dalam-islam',
            ],
            [
                'title' => 'Tata Cara Wudhu yang Benar',
                'slug' => 'tata-cara-wudhu-yang-benar',
            ],
            [
                'title' => 'Shalat Wajib: Pengertian dan Tata Cara',
                'slug' => 'shalat-wajib-pengertian-dan-tata-cara',
            ],
            [
                'title' => 'Shalat Sunnah dan Keutamaannya',
                'slug' => 'shalat-sunnah-dan-keutamaannya',
            ],
            [
                'title' => 'Puasa: Syarat, Rukun, dan Hikmahnya',
                'slug' => 'puasa-syarat-rukun-dan-hikmahnya',
            ],
            [
                'title' => 'Zakat: Pengertian dan Jenis-Jenisnya',
                'slug' => 'zakat-pengertian-dan-jenis-jenisnya',
            ],
            [
                'title' => 'Haji: Tata Cara dan Rukun-Rukunnya',
                'slug' => 'haji-tata-cara-dan-rukun-rukunnya',
            ],
            [
                'title' => 'Muamalah dalam Islam',
                'slug' => 'muamalah-dalam-islam',
            ],
            [
                'title' => 'Akad dan Jenis-Jenisnya',
                'slug' => 'akad-dan-jenis-jenisnya',
            ],
            [
                'title' => 'Jual Beli dalam Islam',
                'slug' => 'jual-beli-dalam-islam',
            ],
            [
                'title' => 'Warisan dalam Hukum Islam',
                'slug' => 'warisan-dalam-hukum-islam',
            ],
            [
                'title' => 'Jinayat: Hukum Pidana Islam',
                'slug' => 'jinayat-hukum-pidana-islam',
            ],
            [
                'title' => 'Etika dalam Islam',
                'slug' => 'etika-dalam-islam',
            ],
        ]);

        // Create material statuses
        foreach ($materials as $material) {
            // Set material teacher
            $teacher = $teachers->random();

            $material->update([
                'teacher_id' => $teacher->id,
            ]);

            foreach ($students as $student) {
                MaterialStatus::create([
                    'is_done' => fake()->boolean(),
                    'student_id' => $student->id,
                    'material_id' => $material->id,
                ]);
            }
        }
    }
}
