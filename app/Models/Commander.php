<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commander extends Model
{
    use HasFactory;

    protected $table = 'commanders';
    protected $fillable = ['name', 'url', 'image'];
}
