<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\Sale;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $query=request()->except('_token');
        $name=request()->name;
        //dd($name);
        $where[]=['client_delete','=',1];
        if ($name) {
            $where=[
                ['client_name','like',"%$name%"],
                ['client_delete',1]
            ];
        }
        $arr=Client::leftjoin('sale','client.sale_id','=','sale.sale_id')->where($where)->paginate(2);
        if (request()->ajax()) {
        return view('client.show',['arr'=>$arr,'query'=>$query]);
        }
        return view('client.index',['arr'=>$arr,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res=Sale::all();
        return view('client.create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=request()->except('_token');
        $res=Client::insert($post);
        if ($res) {
            return  redirect('client/index');
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
        $arr=client::find($id);
        $res=Sale::all();
        return view('client.edit',['res'=>$res,'arr'=>$arr]);
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
         $post=request()->except('_token');
        $res=Client::where('client_id','=',$id)->update($post);
        if ($res!==false) {
            return redirect('client/index');
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
        $data=['client_delete'=>2];
        $ret=Client::where('client_id','=',$id)->update($data);
        if ($ret!==false) {
            return redirect('client/index');
        }
    }
}
