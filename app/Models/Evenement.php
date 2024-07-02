<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'event_start_date',
        'event_end_date',
        'location',
        'registration_deadline',
        'places',
        'image',
        'user_id'
    ];
    public function notification(){
        return $this->belongsTo(Notification::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function users(){
    //     return $this->belongsToMany(User::class,'evenement_users')
    //                 ->withPivot('status')
    //                 ->withTimestamps();
    // }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'evenement_users');
    }
}
