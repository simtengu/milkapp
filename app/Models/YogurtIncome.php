<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YogurtIncome extends Model
{
    use HasFactory;
    protected $fillable = ['added_by', 'capacity', 'price', 'quantity', 'amount'];
}
