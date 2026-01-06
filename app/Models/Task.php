<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'type',
        'status',
        'run_at',
        'started_at',
        'finished_at',
        'payload',
        'retries',
        'max_retries',
        'timeout_sec',
        'owner_user_id',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}
