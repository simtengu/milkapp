<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LitreProduction extends Model
{
    use HasFactory;
    protected $fillable = ['id','milk_type','litre'];
}
