<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evacsite extends Model
{
    use HasFactory;

    protected $fillable = [
        'sitename',
        'address',
        'type',
        'status',
        'capacity',
        'room',
        'powerstatus',
        'waterstatus',
        'head',
        'contact',
        'lat',
        'lang'
    ];
}
