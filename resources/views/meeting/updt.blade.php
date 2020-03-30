<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 拜访会议</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<a class="btn btn-info" href="{{url('/meeting/index')}}">展示</a>
<center><h3>拜访会议修改</h3></center><hr>
<form action="{{url('/meeting/update/?id='.$xz->meeting_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id='fm'>
@csrf
<input type="hidden" id='yc' ycid="{{$xz->meeting_id}}">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">业务员名称</label>
		<div class="col-sm-7">
          <select name="sale_id" id="sale_id">
          	<option value="0">请选择业务员</option>
     	      @foreach($ywy as $c)
            <option value="{{$c->sale_id}}" {{$xz['sale_id']==$c->sale_id?'selected':''}}>{{$c->sale_name}}</option>
            @endforeach
          </select>		   
		    <h5>{{$errors->first('sale_id')}}</h5>
		    <span id='sale_idsp'></span>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">客户名称</label>
		<div class="col-sm-7">
          <select name="client_id" id="client_id">
          	<option value="0">请选择客户</option>
            @foreach($yh as $v)
            <option value="{{$v->client_id}}" {{$xz['client_id']==$v->client_id?'selected':''}}>{{$v->client_name}}</option>
            @endforeach       	
          </select>	
			<h5>{{$errors->first('client_id')}}</h5>
			<span id='client_idsp'></span>	   
		</div>
	</div>

<!-- 	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">访问时间</label>
		<div class="col-sm-7">
			<textarea type="text" class="form-control" name="goods_score" id="lastname" cols="30" rows="10" placeholder="商品介绍">    
		    </textarea>
		     <h5>{{$errors->first('goods_score')}}</h5>
		     <span id='js'></span>
		</div>
	</div> -->

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">访问人</label>
		<div class="col-sm-7">
         <input type="text" class="form-control" id="lastname" value="{{$xz->meeting_man}}" name='meeting_man'placeholder="访问人"> 		    
		    <h5>{{$errors->first('meeting_man')}}</h5>
		    <span id='meeting_mansp'></span>
		</div>
	</div>	

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">访问地址</label>
		<div class="col-sm-7">
<input type="text" class="form-control" id="lastname" value="{{$xz->meeting_address}}" name='meeting_address'placeholder="访问地址">          
          <h5>{{$errors->first('meeting_address')}}</h5>
          <span id='meeting_addresssp'></span>
		</div>
	</div>	

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">访问详情</label>
		<div class="col-sm-7">
			<textarea type="text" class="form-control" name="meeting_desc" id="lastname" cols="30" rows="10" placeholder="访问详情">    
        {{$xz->meeting_desc}}
		    </textarea>         
          <h5>{{$errors->first('meeting_desc')}}</h5>
          <span id='meeting_descsp'></span>
        
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">下次访问时间</label>
		<div class="col-sm-7">
         <input type="text" class="form-control" id="lastname" name='meeting_time'placeholder="下次访问时间" value="{{$xz->meeting_time}}">          
          <h5>{{$errors->first('meeting_time')}}</h5>
          <span id='meeting_timesp'></span>
		</div>
	</div>	



	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改信息</button>
		</div>
	</div>
</form>

</body>
</html>
@verbatim
<script>
	$(function(){
//--------------------------------------------------		
	console.log('eva');	
	$(document).on('submit','#fm',function(){
     var ywy=$("#sale_id>option:checked").val();
     var yh=$("#client_id>option:checked").val();
     var fwr=$("[name='meeting_man']").val();
     var dz=$("[name='meeting_address']").val();
     var xx=$("[name='meeting_desc']").val();
     var sj=$("[name='meeting_time']").val();
     
     var f1=false;
     if(ywy==0){
      $("#sale_idsp").html('<find>请选择业务员</find>');
      f1=false;
     }else{
      $("#sale_idsp").html('');
      f1=true;      
     }

     var f2=false;
     if(yh==0){
      $("#client_idsp").html('<find>请选择用户</find>');
      f2=false;
     }else{
      $("#client_idsp").html('');
      f2=true;      
     }     

     var f3=false;
     var zz=/^[\u4e00-\u9fa5 \w]{2,50}$/;
     if(fwr==''){
      $("#meeting_mansp").html('<find>访问人不能为空</find>');
      f3=false;
     }else if(!zz.test(fwr)){
      $("#meeting_mansp").html('<find>访问人中文数字字母下划线2到50位</find>');
      f3=false;      
     }else{
      $("#meeting_mansp").html('');
      f3=true;       
     }  

     var f4=false;
     if(f3==true){
      var idd=$("#yc").attr('ycid');
      $.ajax({
        url:'/meeting/wyis',
        type:'get',
        dataType:'json',
        data:{'ywy':ywy,'yh':yh,'fwr':fwr,'idd':idd},
        async:false,
        success:function(yy){
          if(yy.a1==0){
            $("#meeting_mansp").html('');            
            f4=true;
          }else{
            $("#meeting_mansp").html('<find>访问人名称重复</find>');            
            f4=false;
          }
        }
      });
     }   

     var f5=false;
     var zz2=/^[\u4e00-\u9fa5 \w]{2,50}$/;
     if(dz==''){
      $("#meeting_addresssp").html('<find>访问地址不能为空</find>');
      f5=false;
     }else if(!zz2.test(dz)){
      $("#meeting_addresssp").html('<find>访问地址中文数字字母下划线2到50位</find>');
      f5=false;      
     }else{
      $("#meeting_addresssp").html('');
      f5=true;       
     }    

     var f6=false;
     var zz3=/^[\u4e00-\u9fa5 \w]{2,50}$/;
     if(xx==''){
      $("#meeting_descsp").html('<find>访问详情不能为空</find>');
      f6=false;
     }else if(!zz3.test(xx)){
      $("#meeting_descsp").html('<find>访问详情中文数字字母下划线2到50位</find>');
      f6=false;      
     }else{
      $("#meeting_descsp").html('');
      f6=true;       
     }   

     var f7=false;
     if(sj==''){
      $("#meeting_timesp").html('<find>下次访问时间不能为空</find>');
      f7=false;
     }else{
      $("#meeting_timesp").html('');
      f7=true;       
     }           
     
     if(f1==true&&f2==true&&f3==true&&f4==true&&f5==true&&f6==true&&f7==true){
      console.log('true');
      return true; 
     }else{
      console.log('false');
      return false; 
     }
     //console.log(ywy,yh,fwr,dz,'.'+xx+'.',sj);
                        
     

	});
//--------------------------------------------------		
    });
</script>
@endverbatim