<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vente extends Model
{
    use HasFactory;

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }
    
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
