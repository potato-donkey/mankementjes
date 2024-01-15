<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = [
        'status',
        'description',
    ];

    protected $primaryKey = 'status';
    
    protected $incrementing = false;

    protected $keyType = 'string';
}