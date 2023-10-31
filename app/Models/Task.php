<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'file_id',
        'status',
        'type',
    ];

    protected $table = 'tasks';

    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PROCESS => 'В обработке',
            self::STATUS_SUCCESS => 'Завершено успешно',
            self::STATUS_ERROR => 'Ошибка',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function failedRows(): HasMany
    {
        return $this->hasMany(FailedRow::class);
    }
}
