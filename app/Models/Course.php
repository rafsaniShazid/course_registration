<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey='course_id';
    
    protected $fillable=[
        'title',
        'credits',
        'dept_id',
        'instructor_id'
    ];
    protected $casts= [
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class,'dept_id','dept_id');
    }
    
    public function instructor():BelongsTo
    {
        return $this->belongsTo(Instructor::class,'instructor_id','instructor_id');
    }
    
    public function registrations():HasMany
    {
        return $this->hasMany(Registration::class,'course_id','course_id');
    }

    
}
