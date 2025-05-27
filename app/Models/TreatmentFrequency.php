<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TreatmentFrequency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'amount',
    ];

    protected function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class);
    }

    protected function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
//test
