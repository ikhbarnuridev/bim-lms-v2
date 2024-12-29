<?php

namespace Database\Seeders;

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
        StudentFactory::new()->count(60)->create();

        // Create teachers
        $teachers = UserFactory::new()->count(5)->create();
        foreach ($teachers as $teacher) {
            $teacher->assignRole('teacher');
        }

        // Create materials
        MaterialFactory::new()->createMany([
            [
                'title' => 'Pengertian Fiqih',
                'slug' => 'pengertian-fiqih',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Rukun Islam dan Penjelasannya',
                'slug' => 'rukun-islam-dan-penjelasannya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Thaharah: Bersuci dalam Islam',
                'slug' => 'thaharah-bersuci-dalam-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Tata Cara Wudhu yang Benar',
                'slug' => 'tata-cara-wudhu-yang-benar',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Shalat Wajib: Pengertian dan Tata Cara',
                'slug' => 'shalat-wajib-pengertian-dan-tata-cara',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Shalat Sunnah dan Keutamaannya',
                'slug' => 'shalat-sunnah-dan-keutamaannya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Puasa: Syarat, Rukun, dan Hikmahnya',
                'slug' => 'puasa-syarat-rukun-dan-hikmahnya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Zakat: Pengertian dan Jenis-Jenisnya',
                'slug' => 'zakat-pengertian-dan-jenis-jenisnya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Haji: Tata Cara dan Rukun-Rukunnya',
                'slug' => 'haji-tata-cara-dan-rukun-rukunnya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Muamalah dalam Islam',
                'slug' => 'muamalah-dalam-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Akad dan Jenis-Jenisnya',
                'slug' => 'akad-dan-jenis-jenisnya',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Jual Beli dalam Islam',
                'slug' => 'jual-beli-dalam-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Warisan dalam Hukum Islam',
                'slug' => 'warisan-dalam-hukum-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Jinayat: Hukum Pidana Islam',
                'slug' => 'jinayat-hukum-pidana-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
            [
                'title' => 'Etika dalam Islam',
                'slug' => 'etika-dalam-islam',
                'created_by' => $teachers->random()->first()->id,
                'updated_by' => $teachers->random()->first()->id,
            ],
        ]);
    }
}
