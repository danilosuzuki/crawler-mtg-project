<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspiration extends Model
{
    use HasFactory;

    protected $table = 'inspirations';
    protected $fillable = ['name', 'image', 'is_commander', 'value'];
}
