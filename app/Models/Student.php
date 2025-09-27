<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table= 'students';
    protected $primaryKey= 'student_id';

    protected $fillable=[
        'name',
        'email',
        'major',
        'year'
    ];
    
    protected $casts=[
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];
    
    /**
     * Get the registrations for the student.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'student_id', 'student_id');
    }
}
