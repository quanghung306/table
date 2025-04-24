<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodcuts extends Model
{
    use HasFactory;
    protected $fillable = [
        'ProductName',
        'Category',
        'Stock',
        'Price'
    ];
}
