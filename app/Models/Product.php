<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUlids;
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'name',
        'desc',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
