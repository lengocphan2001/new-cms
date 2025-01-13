<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group_stage',
        'machine_type',
        'price',
        'time_to_complete',
        'number_of_employee',
        'status'
    ];

    public function stageGroup() {
        return $this->belongsTo(StageGroup::class, 'group_stage');
    }
}
