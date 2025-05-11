<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'name',
    ];

    public function students():BelongsToMany{
        return $this->belongsToMany(Student::class ,'enrollments' ,'course_id' , 'student_id' );
    }

    public function teacher():BelongsTo{
        return $this->belongsTo(Teacher::class);
    }


}
