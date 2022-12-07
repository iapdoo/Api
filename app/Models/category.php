<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=[
        'name_ar',
        'title_ar',
        'description_ar',
        'name_en',
        'title_en',
        'description_en',
    ];

}
