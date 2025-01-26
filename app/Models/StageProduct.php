<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stage_ids',
        'group_stage_ids'
    ];

    protected $casts = [
        'stage_ids' => 'array',
        'group_stage_ids' => 'array'
    ];
}
