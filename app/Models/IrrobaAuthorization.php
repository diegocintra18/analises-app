<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrrobaAuthorization extends Model
{
    use HasFactory;

    protected $table = 'irrobaAuthorization';

    protected $fillable = ['authorization'];
}
