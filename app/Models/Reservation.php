<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;
    

    public function evenements(): BelongsToMany
    {
        return $this->belongsToMany(Evenement::class, 'reservations');
    }
}
