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
            CREATE TABLE departments(
            dept_id int auto_increment primary key,
            dept_name varchar(100) not null unique,
            location varchar(150),
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp
            );
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('drop table if exists departments');
    }
};
