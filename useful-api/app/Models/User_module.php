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
        'user_id',
        'module_id',
        'active',
    ];

    public function module()
    {
         return $this->belongsTo(Module::class, 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
