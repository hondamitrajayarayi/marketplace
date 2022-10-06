<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUpdate extends Model
{
    public $connection = "oracle";
    public $timestamps = false;
    protected $table = 'mitra.LOG_UPDATE_MP';
}
