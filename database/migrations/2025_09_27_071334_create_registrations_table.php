<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            create table registrations (
            reg_id int auto_increment primary key,
            student_id int not null,
            course_id varchar(10) not null,
            semester varchar(20) not null,
            grade char(2),
            registered_at timestamp default current_timestamp,
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp,
            foreign key (student_id) references students(student_id) on delete cascade,
            foreign key (course_id) references courses(course_id) on delete cascade,
            unique (student_id, course_id, semester)
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop table if exists registrations');
    }
};
