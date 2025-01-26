<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function stages() {
        return $this->hasMany(Stage::class, 'group_stage', 'id');
    }
}
