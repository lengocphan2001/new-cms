<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stage_id',
        'user_id',
        'group_stage_id',
        'total'
    ];
}
