<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $table = 'locations';

    protected $fillable = [
        'id',
        'park',
        'location',
        'description',
        'latitude',
        'longitude'
    ];
}