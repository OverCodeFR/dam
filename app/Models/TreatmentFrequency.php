<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TreatmentFrequency extends Pivot
{
    protected $table = 'treatment_frequencies';

    /** @use HasFactory<\Database\Factories\TreatmentFrequencyFactory> */
    use HasFactory;
    public $primaryKey = ['treatment_id', 'frequency_id'];
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'amount',
        'preferred_hour',
        'moment_day_id',
        'frequency_id',
        'treatment_id',
    ];

    protected $casts = [
        'preferred_hour' => 'datetime',
    ];

    public function moment_day(): BelongsTo
    {
        return $this->belongsTo(MomentDay::class, 'moment_day_id');
    }

    public function frequencies()
    {
        return $this->belongsTo(Frequency::class, 'frequency_id');
    }

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }
}
