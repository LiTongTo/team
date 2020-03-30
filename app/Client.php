<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

	//表名
    protected $table = 'client';
    //自增主键
    protected $primaryKey = 'client_id';
    //是否默认增加添加时间与修改时间
    public $timestamps = false;
    //白名单 
    //protected $fillable = ['name'];
    //黑名单
    protected $guarded = [];

}
