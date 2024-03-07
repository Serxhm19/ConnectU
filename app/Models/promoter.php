<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promoter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nif',
        'name',
        'email',
        'description',
        'category_id',
        'password'
    ];
}
