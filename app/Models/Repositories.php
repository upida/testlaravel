<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repositories extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'full_name',
        'owner_login'
    ];
}
