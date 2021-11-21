<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'question_id',
        'subject_id',
        'description',
        'type',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'answer',
    ];
}