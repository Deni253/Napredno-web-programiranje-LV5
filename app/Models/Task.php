<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    'teacher_id',
    'title_hr',
    'title_en',
    'description',
    'study_type',
];

    public function students()
    {
        return $this->belongsToMany(User::class, 'prijave')->withPivot('student_name','status');
    }

}
