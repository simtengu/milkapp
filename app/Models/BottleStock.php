<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottleStock extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'milk_type', 'bottle_capacity', 'litre', 'bottle_quantity'];
}
