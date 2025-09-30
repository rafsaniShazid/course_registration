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
                'course_id' => 'CS101',
                'title' => 'Introduction to Programming',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 1  // Dr. John Smith
            ],
            [
                'course_id' => 'CS201',
                'title' => 'Data Structures and Algorithms',
                'credits' => 4.0,
                'dept_id' => 1,
                'instructor_id' => 1  // Dr. John Smith
            ],
            [
                'course_id' => 'CS301',
                'title' => 'Web Development',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 2  // Prof. Sarah Johnson
            ],
            [
                'course_id' => 'CS401',
                'title' => 'Database Systems',
                'credits' => 3.0,
                'dept_id' => 1,
                'instructor_id' => 2  // Prof. Sarah Johnson
            ],

            // Mathematics Courses (dept_id = 2)
            [
                'course_id' => 'MATH101',
                'title' => 'Calculus I',
                'credits' => 4.0,
                'dept_id' => 2,
                'instructor_id' => 3  // Dr. Michael Williams
            ],
            [
                'course_id' => 'MATH201',
                'title' => 'Linear Algebra',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 3  // Dr. Michael Williams
            ],
            [
                'course_id' => 'MATH301',
                'title' => 'Statistics',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 4  // Prof. Emily Brown
            ],
            [
                'course_id' => 'MATH401',
                'title' => 'Discrete Mathematics',
                'credits' => 3.0,
                'dept_id' => 2,
                'instructor_id' => 4  // Prof. Emily Brown
            ],

            // Physics Courses (dept_id = 3)
            [
                'course_id' => 'PHYS101',
                'title' => 'General Physics I',
                'credits' => 4.0,
                'dept_id' => 3,
                'instructor_id' => 5  // Dr. Robert Davis
            ],
            [
                'course_id' => 'PHYS301',
                'title' => 'Quantum Mechanics',
                'credits' => 4.0,
                'dept_id' => 3,
                'instructor_id' => 5  // Dr. Robert Davis
            ],
            [
                'course_id' => 'PHYS201',
                'title' => 'Thermodynamics',
                'credits' => 3.0,
                'dept_id' => 3,
                'instructor_id' => 6  // Prof. Lisa Miller
            ],

            // Business Administration Courses (dept_id = 4)
            [
                'course_id' => 'BUS101',
                'title' => 'Introduction to Business',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 7  // Dr. James Wilson
            ],
            [
                'course_id' => 'BUS201',
                'title' => 'Marketing Fundamentals',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 7  // Dr. James Wilson
            ],
            [
                'course_id' => 'BUS301',
                'title' => 'Financial Accounting',
                'credits' => 3.0,
                'dept_id' => 4,
                'instructor_id' => 8  // Prof. Maria Garcia
            ],

            // English Literature Courses (dept_id = 5)
            [
                'course_id' => 'ENG101',
                'title' => 'English Composition',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 9  // Dr. David Taylor
            ],
            [
                'course_id' => 'ENG201',
                'title' => 'Shakespeare Studies',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 9  // Dr. David Taylor
            ],
            [
                'course_id' => 'ENG301',
                'title' => 'Modern American Literature',
                'credits' => 3.0,
                'dept_id' => 5,
                'instructor_id' => 10  // Prof. Jennifer Anderson
            ],

            // Chemistry Courses (dept_id = 6)
            [
                'course_id' => 'CHEM101',
                'title' => 'General Chemistry I',
                'credits' => 4.0,
                'dept_id' => 6,
                'instructor_id' => 11  // Dr. Christopher Lee
            ],
            [
                'course_id' => 'CHEM201',
                'title' => 'Organic Chemistry',
                'credits' => 4.0,
                'dept_id' => 6,
                'instructor_id' => 11  // Dr. Christopher Lee
            ],
            [
                'course_id' => 'CHEM301',
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
