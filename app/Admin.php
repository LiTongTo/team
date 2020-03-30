<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table="admin";//指定表名
    protected $primaryKey='admin_id';//指定主键id
    public $timestamps=false;
    protected $guarded=[];//黑名单为空
}
