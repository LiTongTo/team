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
<center><h3>客户添加列表</h3></center>
<form action="{{url('client/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname"  class="col-sm-2 control-label">客户姓名</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" id="client_name" class="form-control" 
				 name="client_name"  placeholder="请输入客户姓名">

		</div>
	</div>
	<span id="client_name_span"></span>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">客户来源</label>
		<div class="col-sm-6">
			<input id="client_root" type="text" class="form-control" 
				 name="client_root" placeholder="请输入客户名称">

		</div>
	</div>
	<span id="client_root_span"></span>
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
			<input type="text" class="form-control" 
				 name="client_phone" id="client_phone"  placeholder="请输入客户名称">

		</div>
	</div>
	<span id="client_phone_span"></span>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-6">
			@csrf
			<input type="text" class="form-control" 
				 name="client_tel" id="client_tel"  placeholder="请输入客户名称">
<!-- 				<b style="color:red">{{$errors->first('goods_name')}}</b>
 -->
		</div>
	</div>
	<span id="client_tel_span"></span>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">顾客级别</label>
		<div class="col-sm-6">
			<input type="radio" name="client_rank" value="1" checked>普通
			<input type="radio" name="client_rank" value="2">会员
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="button" id="jia" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
	$(function(){
		$("#jia").click(function(){
			var a=false;
			var client_name=$("#client_name").val();
			var client_root=$("#client_root").val();
			var client_phone=$("input[name='client_phone']").val();
			//console.log(client_phone);
			var client_tel=$("#client_tel").val();
			if (client_name=='') {
				$("#client_name_span").html("<span style='color:red'>客户名不能为空</span>");
				a=false;
			}else{
				$("#client_name_span").html('<span style="color:red">√</span>');
				a=true;
			}
			var b = false; 
			if (client_root=='') {
				$("#client_root_span").html("<span style='color:red'>客户来源不能为空</span>");
				b=false;
			}else{
				$("#client_root_span").html('<span style="color:red">√</span>');
				b=true;
			}
				var c =false;
			if (client_phone=='') {
				$("#client_phone_span").html("<span style='color:red'>电话不能为空</span>");
				c=false;
			}else{
				$("#client_phone_span").html('<span style="color:red">√</span>');
				c=true;
			}
				var d =false;
			if (client_tel=='') {
				$("#client_tel_span").html("<span style='color:red'>手机号不能为空</span>");
				d=false;
			}else{
				$("#client_tel_span").html('<span style="color:red">√</span>');
				d=true;
			}
			if (a && b && c &&d) {
				$('form').submit();
			}

		});
	})
</script>


 