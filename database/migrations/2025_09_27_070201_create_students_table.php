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
            create table students (
            student_id int auto_increment primary key,
            name varchar(100) not null,
            email varchar(150) not null unique,
            major varchar(100) not null,
            year enum("1", "2", "3", "4", "Graduate") not null default "1",
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop table if exists students');
    }
};
