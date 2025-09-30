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
            create table courses (
            course_id varchar(10) primary key,
            title varchar(150) not null,
            credits decimal(3,1) not null,
            dept_id int not null,
            instructor_id int,
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp,
            foreign key(dept_id) references departments(dept_id) on delete cascade,
            foreign key(instructor_id) references instructors(instructor_id) on delete set null
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop table if exists courses');
    }
};
