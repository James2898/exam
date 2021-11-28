<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamineeForm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'examinee_id',
        'exam_id',
        'subject_id',
        'question_id',
        'question',
        'answer',
        'result',
    ];
}