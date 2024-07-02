<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'evenement_id', // Add 'evenement_id' to the fillable array
        'user_id',
        // Any other fields you want to mass assign
    ];

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
