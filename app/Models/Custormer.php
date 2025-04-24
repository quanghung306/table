<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custormer extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name',
        'Position',
        'Status',
        'Gender',
        'Email',
        'Avatar',

    ];
}
