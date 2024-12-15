<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plot extends Model
{
    protected $table = 'plots';
    public const STATUS_EMPTY = 'empty';
    public const STATUS_SOLD = 'sold';
    public const STATUS_DEPOSITED = 'deposited';
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
        'checked_deposit',
    ];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
