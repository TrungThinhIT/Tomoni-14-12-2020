<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devvn_City extends Model
{
    use HasFactory;
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    public $timestamps = false;
}
