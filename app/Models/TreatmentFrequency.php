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
    ];

    public function frequency(): BelongsTo
    {
        return $this->belongsTo(Frequency::class);
    }

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }
}
