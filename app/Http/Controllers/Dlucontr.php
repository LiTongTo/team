<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;
 
use Illuminate\Support\Facades\Cookie;

class Dlucontr extends Controller
{
//-----------------------------------------------------
   public function dlq(){
   	return view('dlu.dlu');
   }
//-----------------------------------------------------
   public function dle(){
      $sj=request()->all();

      $yz=Admin::where('admin_name',$sj['admin_name'])->first();
           
      if(!$yz){
      request()->session()->forget('yhdl');
      return redirect('/dlq')->with('yhcw','用户不存在');      	
      }

      $mm=decrypt($yz['admin_pwd']);
      if($mm!=$sj['admin_pwd']){
      request()->session()->forget('yhdl');
      return redirect('/dlq')->with('mmcw','密码错误'); 
      }    
      if(($sj['admin_name']==$yz['admin_name'])&&($sj['admin_pwd']==$mm)){
        $jz=array_key_exists('jz',$sj);
        if($jz==true){
          Cookie::queue('htdl',$yz,7*24*60);
          request()->cookie('htdl');
        }
      request()->session()->put('yhdl',$yz);
      return redirect('/meeting/index');      	
      }  
   }  
//-----------------------------------------------------
}
