<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'date_created',
        'setevik',
        'member_count',
        'has_outsource',
        'has_investors',
        'date_deadline',
        'on_time',
        'step_1',
        'step_2',
        'step_3',
        'step_4',
        'date_signed',
        'service_count',
        'comment',
        'effectiveness',
    ];

    protected $table = 'projects';
}
