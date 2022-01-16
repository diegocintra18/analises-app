<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irroba extends Model
{
    use HasFactory;

    protected $table = 'irroba';

    protected $fillable = ['user', 'password', 'authorization'];
}
