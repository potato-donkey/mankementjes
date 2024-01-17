<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    use HasFactory;

    public $table = 'park';

    public $fillable = [
        'identifier',
        'name',
    ];

    public $primaryKey = 'identifier';
    public $keyType = 'string';
    public $incrementing = false;
}