<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    use HasFactory;
	public $timestamps = false; // отключение использование created_at и updated_at
}
