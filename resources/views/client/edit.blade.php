<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h3>客户修改列表</h3></center>
<form action="{{url('client/update'.$arr->client_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">客户姓名</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="client_name"  placeholder="请输入客户姓名" value="{{$arr->client_name}}">

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">客户来源</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="client_root"  placeholder="请输入客户名称" value="{{$arr->client_root}}">

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">业务员</label>
	<select name="sale_id">
		<option value="0">请选择--</option>
		@foreach ($res as $v)
		<option value="{{$v->sale_id}}">{{$v->sale_name}}</option>
		@endforeach
	</select>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">电话</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="client_phone"  placeholder="请输入客户名称" value="{{$arr->client_phone}}">

		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" id="firstname" 
				 name="client_tel"  placeholder="请输入客户名称" value="{{$arr->client_tel}}">
<!-- 				<b style="color:red">{{$errors->first('goods_name')}}</b>
 -->
		</div>
	</div>		
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顾客级别</label>
		<div class="col-sm-6">
			<input type="radio" name="client_rank" value="1" checked>普通
			<input type="radio" name="client_rank" value="2">会员
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>

 