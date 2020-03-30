<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $table='sale';
	protected $primaryKey = 'sale_id';
    public $timestamps = false;
}
