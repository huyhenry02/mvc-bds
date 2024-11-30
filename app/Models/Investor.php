<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investor extends Model
{
    protected $table = 'investors';
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'description',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
