<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
    public function getRemainingPlacesAttribute()
    {
        return $this->places - $this->users()->count();
    }

}
