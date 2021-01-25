<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devvn_District extends Model
{
    use HasFactory;
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    public $timestamps = false;
}
