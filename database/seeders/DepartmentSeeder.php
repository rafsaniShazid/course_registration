<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'dept_name' => 'Computer Science',
                'location' => 'Engineering Building, Floor 3'
            ],
            [
                'dept_name' => 'Mathematics',
                'location' => 'Science Building, Floor 2'
            ],
            [
                'dept_name' => 'Physics',
                'location' => 'Science Building, Floor 4'
            ],
            [
                'dept_name' => 'Business Administration',
                'location' => 'Business Building, Floor 1'
            ],
            [
                'dept_name' => 'English Literature',
                'location' => 'Arts Building, Floor 2'
            ],
            [
                'dept_name' => 'Chemistry',
                'location' => 'Science Building, Floor 3'
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
