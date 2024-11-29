<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $table = 'investors';
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'description',
    ];
}
