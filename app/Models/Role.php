<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\RoleKeyEnum;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
    ];

    protected $casts = [
        'key' => RoleKeyEnum::class,
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
