<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bling extends Model
{
    use HasFactory;

    protected $table = 'bling';

    protected $fillable = ['account_name', 'api_key'];
}
