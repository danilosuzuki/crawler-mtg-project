<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = [
        'name',
        'type',
        'black',
        'white',
        'red',
        'green',
        'blue',
        'cmc',
        'text',
        'image',
        'scryfall_uri',
    ];
}
