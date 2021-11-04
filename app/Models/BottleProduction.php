<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BottleProduction extends Model
{
    use HasFactory;
    protected $fillable = ['id','milk_type','bottle_capacity','litre'];
}
