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

    public $primaryKey = 'status';
    
    public $incrementing = false;

    public $keyType = 'string';
}