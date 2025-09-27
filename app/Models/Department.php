<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    // Specify the table name (optional since Laravel can guess from class name)
    protected $table = 'departments';
    
    // Specify the primary key column name
    protected $primaryKey = 'dept_id';
    
    // The attributes that are mass assignable
    protected $fillable = [
        'dept_name',
        'location'
    ];
    
    // The attributes that should be cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * Get the instructors for the department.
     */
    public function instructors(): HasMany
    {
        return $this->hasMany(Instructor::class, 'dept_id', 'dept_id');
    }
    
    /**
     * Get the courses for the department.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'dept_id', 'dept_id');
    }
}
