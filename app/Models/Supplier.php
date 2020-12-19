<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    protected $table = 'supplier';

    public function getIsStartupAttribute(){
        return $this->rank == 0;
    }
    public function getIsStandardAttribute(){
        return $this->rank == 1;
    }
    public function getIsBusinessAttribute(){
        return $this->rank == 2;
    }
    public function getIsVipAttribute(){
        return $this->rank == 3;
    }
}
