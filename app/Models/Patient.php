<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\PersonalAccessToken;

class Patient extends Authenticatable
{
    use HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'user_id',
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function intakes()
    {
        return $this->hasMany(TreatmentIntake::class);
    }

    public function patient_users(): HasMany
    {
        return $this->hasMany(PatientUser::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function token(): MorphOne
    {
        return $this->morphOne(PersonalAccessToken::class, 'tokenable');
    }

}
