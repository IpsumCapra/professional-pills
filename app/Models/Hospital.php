<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province'
    ];

    // A hospital belongs to many users
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // Search by a query
    public static function search($query) {
        return static::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('province', 'LIKE', '%' . $query . '%');
    }
}
