<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'description',
        'patient_id',
        'treatment_id',
        'isDone',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'isDone' => 'boolean',
    ];

    public $timestamps = false;

    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
