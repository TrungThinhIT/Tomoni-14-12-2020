<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAdmin extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'noteshop_admin';
}
