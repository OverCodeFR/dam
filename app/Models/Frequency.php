<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frequency extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class);
    }

    public function treatment_frequencies()
    {
        return $this->hasMany(TreatmentFrequency::class);
    }
}
