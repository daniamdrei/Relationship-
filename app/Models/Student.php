<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=[
        'name',
    ];

    public function courses(){
        return $this->belongsToMany(Course::class , 'enrollments' ,'student_id' , 'course_id');
    }
}
