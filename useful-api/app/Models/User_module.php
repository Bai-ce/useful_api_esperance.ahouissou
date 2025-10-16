<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User_module extends Model
{
    //

    use HasFactory;
    protected $fillable = [
        'active'
    ];

    public function user()
    {
        return $this->hasMany(Module::class);
    }

    public function user_module(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
