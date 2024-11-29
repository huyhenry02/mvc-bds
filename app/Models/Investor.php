<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $table = 'investors';
    protected $fillable = [
        'email',
        'phone_number',
        'description',
    ];
}
