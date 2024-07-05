<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'address',
        'contact_detail',
        'activity_area',
        'ninea',
        'creation_date',
        'account_status',
        'validation_status',
        'password',
        'is_association'
    ];

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

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        $parts = explode(' ', $this->name);
        return $parts[0] ?? '';
    }

    /**
     * Get the user's last name.
     *
     * @return string
     */
    public function getLastNameAttribute()
    {
        $parts = explode(' ', $this->name);
        return isset($parts[1]) ? $parts[1] : '';
    }

    protected static function booted()
    {
        // Séparation du nom complet en prénom et nom de famille lors de la création de l'utilisateur
        static::creating(function ($user) {
            $split = explode(" ", $user->name);
            $user->firstname = array_shift($split); // Prénom
            $user->lastname = implode(" ", $split); // Nom de famille restant

            if ($user->is_association) {
                $user->assignRole('association');
            } else {
                $user->assignRole('user');
            }
        });
    }
}
