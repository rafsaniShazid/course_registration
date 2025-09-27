<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Computer Science Courses (dept_id = 1)
            [
                'title' => 'Introduction to Programming',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 1  // Dr. John Smith
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'credits' => 4.0,
                'dept_id' => 1,
                'instructor_id' => 1  // Dr. John Smith
            ],
            [
                'title' => 'Web Development',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 2  // Prof. Sarah Johnson
            ],
            [
                'title' => 'Database Systems',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 2  // Prof. Sarah Johnson
            ],

            // Mathematics Courses (dept_id = 2)
            [
                'title' => 'Calculus I',
                'credits' => 4.0,
                'dept_id' => 2,
                'instructor_id' => 3  // Dr. Michael Williams
            ],
            [
                'title' => 'Linear Algebra',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 3  // Dr. Michael Williams
            ],
            [
                'title' => 'Statistics',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 4  // Prof. Emily Brown
            ],
            [
                'title' => 'Discrete Mathematics',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 4  // Prof. Emily Brown
            ],

            // Physics Courses (dept_id = 3)
            [
                'title' => 'General Physics I',
                'credits' => 4.0,
                'dept_id' => 3,
                'instructor_id' => 5  // Dr. Robert Davis
            ],
            [
                'title' => 'Quantum Mechanics',
                'credits' => 4.0,
                'dept_id' => 3,
                'instructor_id' => 5  // Dr. Robert Davis
            ],
            [
                'title' => 'Thermodynamics',
                'credits' => 3.0,
                'dept_id' => 3,
                'instructor_id' => 6  // Prof. Lisa Miller
            ],

            // Business Administration Courses (dept_id = 4)
            [
                'title' => 'Introduction to Business',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 7  // Dr. James Wilson
            ],
            [
                'title' => 'Marketing Fundamentals',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 7  // Dr. James Wilson
            ],
            [
                'title' => 'Financial Accounting',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 8  // Prof. Maria Garcia
            ],

            // English Literature Courses (dept_id = 5)
            [
                'title' => 'English Composition',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 9  // Dr. David Taylor
            ],
            [
                'title' => 'Shakespeare Studies',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 9  // Dr. David Taylor
            ],
            [
                'title' => 'Modern American Literature',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 10  // Prof. Jennifer Anderson
            ],

            // Chemistry Courses (dept_id = 6)
            [
                'title' => 'General Chemistry I',
                'credits' => 4.0,
                'dept_id' => 6,
                'instructor_id' => 11  // Dr. Christopher Lee
            ],
            [
                'title' => 'Organic Chemistry',
                'credits' => 4.0,
                'dept_id' => 6,
                'instructor_id' => 11  // Dr. Christopher Lee
            ],
            [
                'title' => 'Analytical Chemistry',
                'credits' => 3.0,
                'dept_id' => 6,
                'instructor_id' => 12  // Prof. Amanda White
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
