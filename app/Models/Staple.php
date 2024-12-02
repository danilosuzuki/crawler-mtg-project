<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staple extends Model
{
    use HasFactory;

    protected $table = 'staples';
    protected $fillable = ['name', 'appearences', 'image'];
}
