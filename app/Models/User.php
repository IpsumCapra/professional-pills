<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Just a list with all the countries of the world in English
    const PROVINCES = ["Drenthe", "Flevoland", "Friesland", "Gelderland", "Groningen", "Limburg", "Noord-Brabant", "Noord-Holland", "Overijssel", "Utrecht", "Zeeland", "Zuid-Holland"];

    // A user can be male, female or other
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_OTHER = 2;

    // Several user roles.
    const ROLE_NORMAL = 0;
    const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'insertion',
        'lastname',
        'gender',
        'birthday',
        'email',
        'phone',
        'address',
        'postcode',
        'city',
        'province',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Get user full name (firstname insertion lastname)
    public function name()
    {
        if ($this->insertion != null) {
            return $this->firstname . ' ' . $this->insertion . ' ' . $this->lastname;
        } else {
            return $this->firstname . ' ' . $this->lastname;
        }
    }

    // A user belongs to many hospitals
    public function hospitals() {
        return $this->belongsToMany(Hospital::class, 'hospital_patients', 'patient_id', 'hospital_id')->withTimestamps();
    }

    public function trials() {
        return $this->hasMany(Research::class, 'patient_id');
    }

    // Return a sort function to sort user by sort name (lastname, insertion firstname)
    public static function sortByName()
    {
        return function ($user, $key) {
            if ($user->insertion != null) {
                return $user->lastname . ', ' . $user->insertion . ' ' . $user->firstname;
            } else {
                return $user->lastname . ' ' . $user->firstname;
            }
        };
    }

    // Search by a query
    public static function search($query)
    {
        return static::where('firstname', 'LIKE', '%' . $query . '%')
            ->orWhere('insertion', 'LIKE', '%' . $query . '%')
            ->orWhere('lastname', 'LIKE', '%' . $query . '%')
            ->orWhere('email', 'LIKE', '%' . $query . '%');
    }
}
