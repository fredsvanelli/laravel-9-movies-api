<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug',
        'name',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
