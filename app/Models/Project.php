<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $table = 'projects';
    public const STATUS_ON_SALE= 'on_sale';
    public const STATUS_COMPLETED= 'completed';
    public const STATUS_UPCOMING= 'upcoming';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'city_id',
        'district_id',
        'specific_address',
        'account_holder',
        'account_number',
        'bank',
        'investor_id',
        'start_date',
        'end_date',
        'status',
        'qr_code',
        'image_project',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }

    public function zones(): HasMany
    {
        return $this->hasMany(Zone::class);
    }

    public function projectInvestors(): HasMany
    {
        return $this->hasMany(ProjectInvestor::class);
    }

    public function investors(): BelongsToMany
    {
        return $this->belongsToMany(Investor::class, 'project_investor', 'project_id', 'investor_id');
    }
}
