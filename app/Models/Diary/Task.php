<?php

namespace App\Models\Diary;

use App\Enums\Tasks\TaskStatusEnum;
use App\Models\User;
use App\Observers\Diary\Task\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

#[ObservedBy([TaskObserver::class])]
class Task extends Model
{
    use HasFactory;
public $timestamps = false;
    public CONST UPDATED_AT = false;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'type',
        'status_change_date',
        'due_date',
        'start_time',
        'stop_time',
    ];

    protected $casts = [
        'due_date'           => 'datetime:Y-m-d H:i:s',
        'start_time'         => 'datetime:H:i',
        'end_time'           => 'datetime:H:i',
        'status_change_date' => 'datetime:Y-m-d H:i:s',
        'created_at'         => 'datetime:Y-m-d H:i:s',
        'status'             => TaskStatusEnum::class
    ];

    protected static function booted()
    {
        // only owner can see the tasks
        static::addGlobalScope('user', function (Builder $builder) {
            // todo: dodać obsługę ról kiedy zostaną zaimplementowane
            // np. admin moze widzec wszystkie taski etc.
            $builder->where('user_id', Auth::id());
        });
    }

    public function diaryDay(): BelongsTo
    {
        return $this->belongsTo(DiaryDay::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
