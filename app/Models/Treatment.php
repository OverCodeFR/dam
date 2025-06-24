<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'dosage',
        'unit',
        'start_at',
        'end_at',
        'patient_id',
        'treatment_type_id',
        'is_done',
    ];

    public $timestamps = false;

    protected $with = ['treatment_type', 'treatment_frequencies', 'stock'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_at' => 'date',
            'end_at' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function frequencies()
    {
        return $this->hasMany(TreatmentFrequency::class);
    }

    public function intakes()
    {
        return $this->hasMany(TreatmentIntake::class);
    }

    public function treatment_type(): BelongsTo
    {
        return $this->belongsTo(TreatmentType::class);
    }

    public function treatment_frequencies()
    {
        return $this->hasMany(TreatmentFrequency::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
