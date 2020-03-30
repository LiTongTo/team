<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员修改页面</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<center><h2>管理员修改</h2></center><a href="{{url('/admin/index')}}" class="btn btn-default">列表</a><hr/>
  <!-- @if ($errors->any())
    <div class='alert alert-danger'>
	<ul>
	@foreach($errors->all() as $error)
	 <li>{{ $error }}</li>@endforeach
	</ul>
	</div>
  @endif -->
<form action="{{url('/admin/update/'.$res->admin_id)}}" method="post" class="form-horizontal" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="admin_name" name="admin_name" value="{{$res->admin_name}}"
			  placeholder="请输入管理员名称">
               <span id='span_name' style='color:red; font-weight:bold;'></span>
				   <b style='color:red'>{{$errors->first('admin_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" id="firstname" name="admin_pwd"
				   placeholder="密码......" value="{{$res->admin_pwd}}">
			  <b style='color:red'>{{$errors->first('admin_pwd')}}</b>
		</div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员级别</label>
		<div class="col-sm-8">
			 <select name="admin_level" id="" class="form-control">
                <option value="">请选择</option>
				@if($res->admin_level==1)
                <option value="1" selected>业务员</option>
                <option value="2">产品经理</option> 
				@else if($res->admin_level==2)
				<option value="1">业务员</option>
                <option value="2" selected>产品经理</option> 
				@endif
            </select>
            <b style='color:red'>{{$errors->first('admin_level')}}</b>
		</div>
    </div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="admin_email"
				   placeholder="请输入邮箱" value="{{$res->admin_email}}">
			  <b style='color:red'>{{$errors->first('admin_email')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">电话</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="admin_tel"
				   placeholder="请输入电话..." value="{{$res->admin_tel}}">
			  <b style='color:red'>{{$errors->first('admin_tel')}}</b>
		</div>
    </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
       $(document).on('blur','#admin_name',function(){
               var admin_name=$(this).val();
               var reg=/^[a-zA-Z0-9_\u4e00-\u9fa5]{2,30}$/;
               if(admin_name==''){
                  $('#span_name').text('管理员名称不能为空');
               }else if(!reg.test(admin_name)){
                $('#span_name').text('管理员名称由2-30的字母、数字、下划线、中文组成');
               }else{
                   $.ajax({
                       url:"/admin/checkOnly",
                       data:{admin_name:admin_name},
                       dataType:"json",
                       successly:function(route){
                         if(route.code=='00000'){
                            $('#span_name').text(route.mgs);
                             
                         }

                         if(route.code=='00001'){
                            $('#span_name').text(route.mgs);
                         }
                     
                       }
                     
                   })
               }
       })
</script>