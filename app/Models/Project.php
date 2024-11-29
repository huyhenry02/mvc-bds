<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $table = 'projects';
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
}
