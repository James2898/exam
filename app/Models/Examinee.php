<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examinee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lrn',
        'user_id',
        'birthdate',
        'gender',
        'marital',
        'prev_school',
        'strand',
        'perm_address',
        'cur_address',
        'no_siblings',
        'order_siblings',
        'weight',
        'height',
        'nationality',
        'religion',
        'f_fname',
        'f_mname',
        'f_lname',
        'f_occupation',
        'f_mobile',
        'm_fname',
        'm_mname',
        'm_lname',
        'm_occupation',
        'm_mobile',
        'emergency_name',
        'emergency_mobile',
        'college',
        'course',
        'status',
    ];
}