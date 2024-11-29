<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plot extends Model
{
    protected $table = 'plots';
    protected $fillable = [
        'zone_id',
        'name',
        'size',
        'price',
        'deposit',
        'specific_address',
        'status',
        'description',
        'main_image',
        'sub_image_1',
        'sub_image_2',
        'sub_image_3',
        'sub_image_4',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
