<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'key',
        'name',
        'project_id',
        'price',
        'quantity',
        'group_management',
        'number_of_employees',
        'time_to_complete',
        'time_each_employee',
        'average_productivity',
        'average_productivity_each_employee',
        'total_time'
    ] ;

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function group() {
        return $this->belongsTo(Group::class,'group_management');
    }
}
