<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mankementje extends Model
{
    use HasFactory;

    protected $table = 'mankementje';

    protected $fillable = [
        'id',
        'park',
        'location',
        'title',
        'description',
        'date',
        'solve_date',
        'image',
        'user_id',
        'status',
        'created_at',
    ];
}