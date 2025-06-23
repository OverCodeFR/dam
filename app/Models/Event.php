<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'preferred_hour',
        'taken_at',
        'treatment_id'
    ];

    public $timestamps = false;

    protected $casts = [
        'preferred_hour' => 'datetime:Y-m-d\TH:i:s',
        'taken_at' => 'datetime:Y-m-d\TH:i:s',
    ];

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
