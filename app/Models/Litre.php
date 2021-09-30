<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Litre extends Model
{
    use HasFactory;
    protected $fillable = ['price_per_litre'];
}
