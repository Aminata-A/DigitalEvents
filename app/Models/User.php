<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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
        'is_association'
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

    protected $casts = [
        'activity_area' => 'string', // Si nécessaire, caster en string
    ];

    public static function getDefaultAccountStatus()
    {
        return 'activated'; 
    }

    public static function getDefaultValidationStatus()
    {
        return 'invalid'; 
    }
    
    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->is_association) {
                $user->assignRole('association');
            } else {
                $user->assignRole('user');
            }
        });
    }
    
}
