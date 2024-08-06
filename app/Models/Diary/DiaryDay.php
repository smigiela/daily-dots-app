<?php

namespace App\Models\Diary;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiaryDay extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'summary',
        'pros',
        'cons'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime:Y-m-d'
        ];
    }

    public function task(): HasMany
    {
        return $this->hasMany(Task::class)
            ->where('due_date', '=', $this['date'])
            ->orWhere('completion_date', '=', $this['date']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
