<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instructor extends Model
{
    protected $table = 'instructors';
    protected $primaryKey = 'instructor_id';

    protected $fillable =[
        'name',
        'email',
        'dept_id'
    ];
    protected $casts =[
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class,'instructor_id','instructor_id');
    }
    
    /**
     * Get the department that owns the instructor.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dept_id', 'dept_id');
    }
    
}
