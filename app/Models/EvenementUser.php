<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EvenementUser extends Model
{
    use HasFactory;

    

    protected $fillable = ['status', 'user_id', 'evenement_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

    // public function evenement()
    // {
    //     return $this->belongsTo(Evenement::class);
    // }
    public function getRemainingPlacesAttribute()
    {
        return $this->places - $this->users()->count();
    }

    // public function evenements(): BelongsToMany
    // {
    //     return $this->belongsToMany(Evenement::class, 'evenement_users');
    // }

    public function evenement()
{
    return $this->belongsTo(Evenement::class, 'evenement_id');
}

}
