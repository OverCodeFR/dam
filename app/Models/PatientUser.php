<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\PersonalAccessToken;

class PatientUser extends Pivot

{
    protected $table = 'patient_user';

    /** @use HasFactory<\Database\Factories\TreatmentFrequencyFactory> */
    use HasFactory;
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'patient_id',
        'user_id',
    ];

    public function patients(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function token(): MorphOne
    {
        return $this->morphOne(PersonalAccessToken::class, 'tokenable');
    }
}
