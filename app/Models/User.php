<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
    ];
    public function evenement()
    {
        $this->hasMany(Evenement::class);
    }
    public function evenements()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getDefaultAccountStatus()
    {
        return 'activated'; 
    }

    public static function getDefaultValidationStatus()
    {
        return 'invalid'; 
    }
}
