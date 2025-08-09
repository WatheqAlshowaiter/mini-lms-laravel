<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'scheduled_at',
        'duration_minutes',
    ];

    protected $casts = [
        'scheduled_at' => 'timestamp',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
