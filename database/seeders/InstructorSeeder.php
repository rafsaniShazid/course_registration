<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = [
            // Computer Science Department (dept_id = 1)
            [
                'name' => 'Dr. John Smith',
                'email' => 'john.smith@university.edu',
                'dept_id' => 1
            ],
            [
                'name' => 'Prof. Sarah Johnson',
                'email' => 'sarah.johnson@university.edu',
                'dept_id' => 1
            ],
            
            // Mathematics Department (dept_id = 2)
            [
                'name' => 'Dr. Michael Williams',
                'email' => 'michael.williams@university.edu',
                'dept_id' => 2
            ],
            [
                'name' => 'Prof. Emily Brown',
                'email' => 'emily.brown@university.edu',
                'dept_id' => 2
            ],
            
            // Physics Department (dept_id = 3)
            [
                'name' => 'Dr. Robert Davis',
                'email' => 'robert.davis@university.edu',
                'dept_id' => 3
            ],
            [
                'name' => 'Prof. Lisa Miller',
                'email' => 'lisa.miller@university.edu',
                'dept_id' => 3
            ],
            
            // Business Administration Department (dept_id = 4)
            [
                'name' => 'Dr. James Wilson',
                'email' => 'james.wilson@university.edu',
                'dept_id' => 4
            ],
            [
                'name' => 'Prof. Maria Garcia',
                'email' => 'maria.garcia@university.edu',
                'dept_id' => 4
            ],
            
            // English Literature Department (dept_id = 5)
            [
                'name' => 'Dr. David Taylor',
                'email' => 'david.taylor@university.edu',
                'dept_id' => 5
            ],
            [
                'name' => 'Prof. Jennifer Anderson',
                'email' => 'jennifer.anderson@university.edu',
                'dept_id' => 5
            ],
            
            // Chemistry Department (dept_id = 6)
            [
                'name' => 'Dr. Christopher Lee',
                'email' => 'christopher.lee@university.edu',
                'dept_id' => 6
            ],
            [
                'name' => 'Prof. Amanda White',
                'email' => 'amanda.white@university.edu',
                'dept_id' => 6
            ]
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }
    }
}
