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



    // Search by a query
    public static function search($query) {
        return static::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('province', 'LIKE', '%' . $query . '%');
    }
}
