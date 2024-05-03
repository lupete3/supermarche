<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

    public function creances(): HasMany
    {
        return $this->hasMany(Creance::class);
    }

}
