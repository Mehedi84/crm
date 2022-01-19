<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead_details extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'firstname', 'lastname', 'company', 'industry', 'rating', 'pnumber', 'site', 'leadstatus', 'leadsource', 'designation', 'assign', 'updated_at'];
}
