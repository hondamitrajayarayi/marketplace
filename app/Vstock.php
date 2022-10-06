<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vstock extends Model
{
    public $connection = "oracle";
    public $timestamps = false;
    protected $table = 'mitra.VI_STOCK_MPLC_KONSOL';
}
