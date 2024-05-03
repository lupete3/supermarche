<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'reste',
        'creance_id',
        'client_id'
    ];

    public function creance(): BelongsTo
    {
        return $this->belongsTo(Creance::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


}
