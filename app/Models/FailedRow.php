<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'row',
        'message',
        'task_id',
    ];

    protected $table = 'failed_rows';
}
