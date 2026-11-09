<?php

namespace App\Models;

use App\Traits\AutoSortOrderById;
use App\Traits\HasCategoryOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, HasCategoryOptions, AutoSortOrderById;
    
    protected $fillable = [
        'name',
        'category',
        'percentage',
        'icon',
        'theme',
        'sort_order',
    ];
}
