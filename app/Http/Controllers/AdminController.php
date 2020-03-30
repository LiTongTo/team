<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use Validator;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query=request()->all();
        // dump($query);
         $where=[];
         if(!empty($query['admin_name'])){
            $where[]=["admin_name","like","%".$query['admin_name']."%"];
         }
        
        $res=Admin::where($where)->paginate(3); 
        return view('admin.index',['res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data=request()->except('_token');
        //  dd($data);
        //验证
          $validator=Validator::make($data,[
              'admin_name'=>'required|regex:/^[\x{4e00-\x9fa5}\w]{2,30}$/u|unique:admin',
              'admin_pwd'=>'required|regex:/^[\w]{6,15}$/',
              'admin_email'=>'required|regex:/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/',
              'admin_tel'=>'required|regex:/^1[356789]\d{9}$/',
              'admin_level'=>'required'
            ],
               
           [
               'admin_name.required'=>'管理员名称不能为空',
               'admin_name.regex'=>'管理员由字母、数字、下划线、中文长为2-30位组成',
               'admin_name.unique'=>'改管理员名称已存在',
               'admin_pwd.required'=>'密码不能为空',
               'admin_pwd.regex'=>'密码由数字、字母、下划线组成，长度为6-15位',
               'admin_email.required'=>'邮箱不能为空',
               'admin_email.regex'=>'请输入正确的邮箱格式',
               'admin_tel.required'=>'电话不能为空',
               'admin_tel.regex'=>'请输入正确的电话号码',
               'admin_level.required'=>'管理员级别不能为空'

          ]);

          if ($validator->fails()) {
            return redirect('admin/create')
            ->withErrors($validator)
            ->withInput();
       }
       
       $res=Admin::create($data);
        if($res){
            return redirect('/admin/index');
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
    public function edit($id)
    {
        $res=Admin::where('admin_id',$id)->first();
        return view('admin.edit',['res'=>$res]);
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
        $data=request()->except('_token');
        //dd($data);
          //验证
          $validator=Validator::make($data,[
            'admin_name'=>'required|regex:/^[\x{4e00-\x9fa5}\w]{2,30}$/u|unique:admin',
            'admin_pwd'=>'required|regex:/^[\w]{6,15}$/',
            'admin_email'=>'required|regex:/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/',
            'admin_tel'=>'required|regex:/^1[356789]\d{9}$/',
            'admin_level'=>'required'
          ],
             
         [
             'admin_name.required'=>'管理员名称不能为空',
             'admin_name.regex'=>'管理员由字母、数字、下划线、中文长为2-30位组成',
             'admin_name.unique'=>'改管理员名称已存在',
             'admin_pwd.required'=>'密码不能为空',
             'admin_pwd.regex'=>'密码由数字、字母、下划线组成，长度为6-15位',
             'admin_email.required'=>'邮箱不能为空',
             'admin_email.regex'=>'请输入正确的邮箱格式',
             'admin_tel.required'=>'电话不能为空',
             'admin_tel.regex'=>'请输入正确的电话号码',
             'admin_level.required'=>'管理员级别不能为空'

        ]);

        if ($validator->fails()) {
          return redirect('admin/create')
          ->withErrors($validator)
          ->withInput();
     }       

     $res=Admin::where('admin_id',$id)->update($data);
     // dd($res);
     if($res!==false){
         return redirect('/admin/index');
     }

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Admin::destroy($id);
        if($res){
           return redirect('admin/index');
        }
    }

    public function checkOnly(){
       $admin_name= request()->admin_name;
       $where=[
           ['admin_name','=',$admin_name]
       ];
       $res=Admin::where($where)->first();
       //dd($res);
       if($res){
           return json_encode(['code'=>'00000','msg'=>'管理员名称已存在']);
       }else{
           return json_encode(['code'=>'00001','msg'=>'√']);
       }
    }
}
