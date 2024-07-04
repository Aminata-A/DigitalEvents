<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
        'logo',
        'adress',
        'contact_detail',
        'activity_area',
        'ninea',
        'creation_date',
        'account_status',
        'validation_status',
        'password',
        'is_association'
    ];

    public function evenement()
    {
        return $this->hasMany(Evenement::class);
    }

    public function evenements()
    {
        return $this->belongsToMany(User::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $casts = [
        'activity_area' => 'string',
    ];

    public static function getDefaultAccountStatus()
    {
        return 'activated';
    }

    public static function getDefaultValidationStatus()
    {
        return 'invalid';
    }

    // Ajout des getters pour les attributs firstname et lastname
    public function getFirstnameAttribute()
    {
        $split = explode(' ', $this->attributes['name']);
        return array_shift($split);
    }

    public function getLastnameAttribute()
    {
        $split = explode(' ', $this->attributes['name']);
        array_shift($split);
        return implode(' ', $split);
    }
}
