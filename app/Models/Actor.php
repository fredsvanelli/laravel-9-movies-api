<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'picture',
        'biography',
        'birth_date',
        'birth_place',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class)
            ->withPivot(['order'])
            ->orderBy('year', 'desc');
    }
}
