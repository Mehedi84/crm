<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead_addres extends Model
{
    use HasFactory;
        protected $fillable = ['city', 'state', 'pobox', 'country', 'street', 'description', 'postal_code', 'updated_at'];
}
