<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LitreIncome extends Model
{
    use HasFactory;
    protected $fillable = ['milk_type','volume','price','quantity','amount'];

      
}
