<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TreatmentFrequency extends Pivot
{
    public $primaryKey = ['treatment_id', 'frequency_id'];
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'amount',
    ];

    protected function frequency(): BelongsTo
    {
        return $this->belongsTo(Frequency::class);
    }

    protected function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
