<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'oder';
    public $timestamps = false;

    protected $guarded = [];

    public function Transport(){
        return $this->hasMany(Transport::class, 'codeorder', 'codeorder');
    }

    public function LogAdmin(){
        return $this->hasMany(LogAdmin::class, 'codeorder', 'codeorder');
    }

    public function LogUser(){
        return $this->hasMany(LogUser::class, 'codeorder', 'codeorder');
    }
}
