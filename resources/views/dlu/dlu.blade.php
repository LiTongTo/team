<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 管理员登录</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!-- @if(session('tshi'))
<center>
  <div class="alert alert-danger">{{session('tshi')}}</div>
</center>
@endif -->
<center><h3>管理员登录</h3></center><hr>
<form action="{{url('/dle')}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id='fm'>
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-7">
			<input type="text" class="form-control" id="firstname" name='admin_name'
				   placeholder="用户名">
		    <h5>{{$errors->first('admin_name')}}</h5>
		    <span id='mc'></span>
        <span>{{session('yhcw')}}</span>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-7">
			<input type="password" class="form-control" id="lastname" name='admin_pwd'
				   placeholder="密码">
			<h5>{{$errors->first('admin_pwd')}}</h5>	 
			<span id='mm'></span>  
      <span>{{session('mmcw')}}</span>
		</div>
	</div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input name='jz' type="checkbox">记住密码七天
        </label>
      </div>
    </div>
  </div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>
