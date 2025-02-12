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

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function stage() {
        return $this->belongsTo(Stage::class,'stage_id');
    }

    public function stageGroup() {
        return $this->belongsTo(StageGroup::class,'group_stage_id');
    }
}
