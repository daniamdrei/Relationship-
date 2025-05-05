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

    public function student():BelongsToMany{
        return $this->belongsToMany(Student::class);
    }

    public function teacher():BelongsTo{
        return $this->belongsTo(Teacher::class);
    }


}
