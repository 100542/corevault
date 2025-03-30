<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address',  'type'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_wallet')->withPivot('balance')->withTimestamps();
    }
}
