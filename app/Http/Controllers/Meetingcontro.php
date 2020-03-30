<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

use App\Meeting;

use App\Sale;

use App\Client;

use Illuminate\Support\Facades\Redis;

class Meetingcontro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $yw=session('yhdl');
        $sc=request()->all();
        $dj=session('yhdl');
        $whers=[['Meeting.meeting_delete',1]];
        //$pj='';
        if(array_key_exists('mc',$sc)){
            if(!$sc['mc']==0){
                $whers[]=['Meeting.client_id',$sc['mc']];
                //$pj=$pj.$sc['mc'];
            }
        }
        if(array_key_exists('fwr',$sc)){
            if(!empty($sc['fwr'])){
                $fwr=$sc['fwr'];
                $whers[]=['meeting_man','like',"%$fwr%"];
                //$pj=$pj.$sc['fwr'];
            }
        }

        if($dj->admin_level==1){
            $whers[]=['Meeting.sale_id',$dj->sale_id];
            //$pj=$pj.$dj['sale_id'];
        }
        //dd('eva');
        // $page=1;
        // if(array_key_exists('page',$sc)){
        //     if(!empty($sc['page'])){
        //       $page=$sc['page'];  
        //     }
        // }

        //$zs=Redis::get('zshc_'.$pj.$page);
        //if(!$zs){
        $zs=Meeting::where($whers)
        ->select('Meeting.*','Sale.sale_name','Sale.sale_id','Client.client_name','Client.client_id')
        ->leftjoin('Sale','Meeting.sale_id','=','Sale.sale_id')
        ->leftjoin('Client','Meeting.client_id','=','Client.client_id')
        ->paginate(4);
        // $zs=serialize($zs);
        // Redis::setex('zshc_'.$pj.$page,60*5,$zs);            
        //}
        //$zs=unserialize($zs);


        $wher=[];
        if($yw->admin_level==1){
          $wher[]=['sale_id',$yw->sale_id];
        }
        $yh=Client::where($wher)->get(); 
          if(request()->ajax()){
            return view('meeting.lists',['zs'=>$zs,'sc'=>$sc,'yh'=>$yh]);
          }       
        return view('meeting.list',['zs'=>$zs,'sc'=>$sc,'yh'=>$yh]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function wyi(){
      $xx=request()->all();
      $sf=Meeting::where([
        ['sale_id',$xx['ywy']],
        ['client_id',$xx['yh']],
        ['meeting_man',$xx['fwr']]
      ])->first();
      if($sf){
        $fh=['a1'=>1,'a2'=>'访问人已存在'];
        return json_encode($fh);
      }else{
        $fh=['a1'=>0,'a2'=>'访问人名称未重复'];
        return json_encode($fh);        
      }  
    }

    public function wyis(){
      $xx=request()->all();
      $sf=Meeting::where([
        ['meeting_id','<>',$xx['idd']],
        ['sale_id',$xx['ywy']],
        ['client_id',$xx['yh']],
        ['meeting_man',$xx['fwr']]
      ])->first();
      if($sf){
        $fh=['a1'=>1,'a2'=>'访问人已存在s'];
        return json_encode($fh);
      }else{
        $fh=['a1'=>0,'a2'=>'访问人名称未重复s'];
        return json_encode($fh);        
      }  
    }

    public function create()
    {   
        $yw=session('yhdl');
        $wher=[];
        if($yw->admin_level==1){
          $wher[]=['sale_id',$yw->sale_id];
        }
        $ywy=Sale::where($wher)->get();

        $yh=Client::where($wher)->get();
 
        return view('meeting.add',['ywy'=>$ywy,'yh'=>$yh]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xx=$request->all();
        $validatedData = $request->validate([
        'sale_id' => 'required|min:1',
        'client_id' => 'required|min:1',
        'meeting_man'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_address'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_desc'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_time'=>'required',
        ],[
        'sale_id.required'=>'业务员必填',
        'sale_id.min'=>'请选择业务员',
        'client_id.max'=>'客户必填',
        'client_id.required'=>'请选择客户',
        'meeting_man.required'=>'访问人必填',
        'meeting_man.regex'=>'访问人中文数字字母下划线2到50位',
        'meeting_address.required'=>'访问地址必填',
        'meeting_address.regex'=>'访问地址中文数字字母下划线2到50位',   
        'meeting_desc.required'=>'访问详情必填',
        'meeting_desc.regex'=>'访问详情中文数字字母下划线2到50位', 
        'meeting_time.required'=>'下次访问时间必填',             
        ]);      

        $tj=Meeting::insert([
        'sale_id'=>$xx['sale_id'],
        'client_id'=>$xx['client_id'],
        'meeting_man'=>$xx['meeting_man'],
        'meeting_address'=>$xx['meeting_address'],
        'meeting_desc'=>$xx['meeting_desc'],
        'add_time'=>time(),
        'meeting_time'=>$xx['meeting_time'],
        ]); 

        if($tj){
            return redirect('/meeting/index');  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {   
        $xx=request()->all();
        $yw=session('yhdl');
        $wher=[];
        if($yw->admin_level==1){
          $wher[]=['sale_id',$yw->sale_id];
        }
        $ywy=Sale::where($wher)->get();

        $yh=Client::where($wher)->get();
        $xz=Meeting::where([['meeting_id',$xx['id']],['meeting_delete',1]])->first();
        return view('meeting.updt',['ywy'=>$ywy,'yh'=>$yh,'xz'=>$xz]);        
        echo'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=0)
    {
        $xx=request()->all();
        $validatedData = $request->validate([
        'sale_id' => 'required|min:1',
        'client_id' => 'required|min:1',
        'meeting_man'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_address'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_desc'=>'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
        'meeting_time'=>'required',
        ],[
        'sale_id.required'=>'业务员必填',
        'sale_id.min'=>'请选择业务员',
        'client_id.max'=>'客户必填',
        'client_id.required'=>'请选择客户',
        'meeting_man.required'=>'访问人必填',
        'meeting_man.regex'=>'访问人中文数字字母下划线2到50位',
        'meeting_address.required'=>'访问地址必填',
        'meeting_address.regex'=>'访问地址中文数字字母下划线2到50位',   
        'meeting_desc.required'=>'访问详情必填',
        'meeting_desc.regex'=>'访问详情中文数字字母下划线2到50位', 
        'meeting_time.required'=>'下次访问时间必填',             
        ]);      

        $xg=Meeting::where('meeting_id',$xx['id'])->update([
        'sale_id'=>$xx['sale_id'],
        'client_id'=>$xx['client_id'],
        'meeting_man'=>$xx['meeting_man'],
        'meeting_address'=>$xx['meeting_address'],
        'meeting_desc'=>$xx['meeting_desc'],
        'add_time'=>time(),
        'meeting_time'=>$xx['meeting_time'],
        ]); 

        if($xg){
            return redirect('/meeting/index');  
        }
    }

    public function updates(){
        $xx=request()->all();
        $xgs=Meeting::where('meeting_id',$xx['id'])->update([$xx['nm']=>$xx['vl']]);
        if($xgs){
            $fh=['a1'=>0,'a2'=>'修改成功s'];
            return json_encode($fh);
        }else{
            $fh=['a1'=>1,'a2'=>'修改失败s'];
            return json_encode($fh);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {   
        $xx=request()->all();
        $id=$xx['id'];
        $sc=Meeting::where([
           [DB::Raw("meeting_id in (".$id.")"),1],
           ['meeting_delete',1]
        ])->update(['meeting_delete'=>'2',]);
        if($sc){
            $fh=['a1'=>0,'a2'=>'删除成功'];
            return json_encode($fh);
        }else{
            $fh=['a1'=>1,'a2'=>'删除失败'];
            return json_encode($fh);            
        }
    }
}
