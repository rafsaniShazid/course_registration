<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            // Computer Science Students
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@student.university.edu',
                'major' => 'Computer Science',
                'year' => '2'
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@student.university.edu',
                'major' => 'Computer Science',
                'year' => '3'
            ],
            [
                'name' => 'Charlie Davis',
                'email' => 'charlie.davis@student.university.edu',
                'major' => 'Computer Science',
                'year' => '4'
            ],

            // Mathematics Students
            [
                'name' => 'Diana Wilson',
                'email' => 'diana.wilson@student.university.edu',
                'major' => 'Mathematics',
                'year' => '2'
            ],
            [
                'name' => 'Ethan Brown',
                'email' => 'ethan.brown@student.university.edu',
                'major' => 'Mathematics',
                'year' => 'Graduate'
            ],
            [
                'name' => 'Fiona Garcia',
                'email' => 'fiona.garcia@student.university.edu',
                'major' => 'Mathematics',
                'year' => '3'
            ],

            // Physics Students
            [
                'name' => 'George Lee',
                'email' => 'george.lee@student.university.edu',
                'major' => 'Physics',
                'year' => '2'
            ],
            [
                'name' => 'Hannah Miller',
                'email' => 'hannah.miller@student.university.edu',
                'major' => 'Physics',
                'year' => '4'
            ],

            // Business Administration Students
            [
                'name' => 'Ian Thompson',
                'email' => 'ian.thompson@student.university.edu',
                'major' => 'Business Administration',
                'year' => '1'
            ],
            [
                'name' => 'Julia Martinez',
                'email' => 'julia.martinez@student.university.edu',
                'major' => 'Business Administration',
                'year' => '2'
            ],
            [
                'name' => 'Kevin Anderson',
                'email' => 'kevin.anderson@student.university.edu',
                'major' => 'Business Administration',
                'year' => '3'
            ],

            // English Literature Students
            [
                'name' => 'Laura Taylor',
                'email' => 'laura.taylor@student.university.edu',
                'major' => 'English Literature',
                'year' => '2'
            ],
            [
                'name' => 'Michael White',
                'email' => 'michael.white@student.university.edu',
                'major' => 'English Literature',
                'year' => '4'
            ],

            // Chemistry Students
            [
                'name' => 'Nina Rodriguez',
                'email' => 'nina.rodriguez@student.university.edu',
                'major' => 'Chemistry',
                'year' => '1'
            ],
            [
                'name' => 'Oliver Clark',
                'email' => 'oliver.clark@student.university.edu',
                'major' => 'Chemistry',
                'year' => '3'
            ],

            // Mixed Major Students
            [
                'name' => 'Petra Lewis',
                'email' => 'petra.lewis@student.university.edu',
                'major' => 'Physics',
                'year' => '1'
            ],
            [
                'name' => 'Quinn Walker',
                'email' => 'quinn.walker@student.university.edu',
                'major' => 'Computer Science',
                'year' => '1'
            ],
            [
                'name' => 'Rachel Hall',
                'email' => 'rachel.hall@student.university.edu',
                'major' => 'Mathematics',
                'year' => '1'
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
