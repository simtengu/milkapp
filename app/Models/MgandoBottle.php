<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MgandoBottle extends Model
{
    use HasFactory;
    protected $fillable = ['capacity','price'];
}
