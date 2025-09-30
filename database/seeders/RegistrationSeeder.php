<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = [
            // Alice Johnson (CS Student) registrations
            [
                'student_id' => 1,  // Alice Johnson
                'course_id' => 'CS101',   // Introduction to Programming
                'semester' => 'Fall 2024',
                'grade' => 'A-'
            ],
            [
                'student_id' => 1,  // Alice Johnson
                'course_id' => 'MATH101',   // Calculus I
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],
            [
                'student_id' => 1,  // Alice Johnson
                'course_id' => 'CS301',   // Web Development
                'semester' => 'Spring 2025',
                'grade' => null     // Not graded yet
            ],

            // Bob Smith (CS Student) registrations
            [
                'student_id' => 2,  // Bob Smith
                'course_id' => 'CS201',   // Data Structures and Algorithms
                'semester' => 'Fall 2024',
                'grade' => 'A'
            ],
            [
                'student_id' => 2,  // Bob Smith
                'course_id' => 'CS401',   // Database Systems
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],
            [
                'student_id' => 2,  // Bob Smith
                'course_id' => 'MATH401',   // Discrete Mathematics
                'semester' => 'Spring 2025',
                'grade' => null
            ],

            // Diana Wilson (Math Student) registrations
            [
                'student_id' => 4,  // Diana Wilson
                'course_id' => 'MATH101',   // Calculus I
                'semester' => 'Fall 2024',
                'grade' => 'A'
            ],
            [
                'student_id' => 4,  // Diana Wilson
                'course_id' => 'MATH201',   // Linear Algebra
                'semester' => 'Fall 2024',
                'grade' => 'A-'
            ],
            [
                'student_id' => 4,  // Diana Wilson
                'course_id' => 'MATH301',   // Statistics
                'semester' => 'Spring 2025',
                'grade' => null
            ],

            // George Lee (Physics Student) registrations
            [
                'student_id' => 7,  // George Lee
                'course_id' => 'PHYS101',   // General Physics I
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],
            [
                'student_id' => 7,  // George Lee
                'course_id' => 'MATH101',   // Calculus I
                'semester' => 'Fall 2024',
                'grade' => 'B'
            ],
            [
                'student_id' => 7,  // George Lee
                'course_id' => 'PHYS201',  // Thermodynamics
                'semester' => 'Spring 2025',
                'grade' => null
            ],

            // Ian Thompson (Business Student) registrations
            [
                'student_id' => 9,  // Ian Thompson
                'course_id' => 'BUS101',  // Introduction to Business
                'semester' => 'Fall 2024',
                'grade' => 'A-'
            ],
            [
                'student_id' => 9,  // Ian Thompson
                'course_id' => 'ENG101',  // English Composition
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],

            // Laura Taylor (English Student) registrations
            [
                'student_id' => 12, // Laura Taylor
                'course_id' => 'ENG101',  // English Composition
                'semester' => 'Fall 2024',
                'grade' => 'A'
            ],
            [
                'student_id' => 12, // Laura Taylor
                'course_id' => 'ENG201',  // Shakespeare Studies
                'semester' => 'Fall 2024',
                'grade' => 'A-'
            ],

            // Nina Rodriguez (Chemistry Student) registrations
            [
                'student_id' => 14, // Nina Rodriguez
                'course_id' => 'CHEM101',  // General Chemistry I
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],
            [
                'student_id' => 14, // Nina Rodriguez
                'course_id' => 'MATH101',   // Calculus I
                'semester' => 'Fall 2024',
                'grade' => 'B'
            ],

            // Quinn Walker (CS Student - 1st year) registrations
            [
                'student_id' => 17, // Quinn Walker
                'course_id' => 'CS101',   // Introduction to Programming
                'semester' => 'Spring 2025',
                'grade' => null
            ],
            [
                'student_id' => 17, // Quinn Walker
                'course_id' => 'ENG101',  // English Composition
                'semester' => 'Spring 2025',
                'grade' => null
            ],

            // Cross-major registrations (students taking electives)
            [
                'student_id' => 3,  // Charlie Davis (CS)
                'course_id' => 'BUS201',  // Marketing Fundamentals
                'semester' => 'Fall 2024',
                'grade' => 'B+'
            ],
            [
                'student_id' => 11, // Kevin Anderson (Business)
                'course_id' => 'CS101',   // Introduction to Programming
                'semester' => 'Spring 2025',
                'grade' => null
            ]
        ];

        foreach ($registrations as $registration) {
            Registration::create($registration);
        }
    }
}
