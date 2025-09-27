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
            create table instructors(
            instructor_id int auto_increment primary key,
            name varchar(100) not null,
            email varchar(150) not null unique,
            dept_id int not null,
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp,
            foreign key (dept_id) references departments(dept_id) on delete cascade
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop table if exists instructors');
    }
};
