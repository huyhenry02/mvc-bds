<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Investor extends Model
{
    protected $table = 'investors';
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'description',
    ];

    public function projectInvestors(): HasMany
    {
        return $this->hasMany(ProjectInvestor::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_investor', 'investor_id', 'project_id');
    }
}
