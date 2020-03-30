<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <center><h2>管理员列表</h2></center><a href="{{url('/admin/create')}}" class="btn btn-default">添加</a><hr/> 
 <form method='get' action="">
     管理员名称<input type="text" name='admin_name' value="">
	 管理员级别 <select name="admin_level" id="">
	                  <option value="">请选择</option>
					  <option value="1">业务员</option>
					  <option value="2">产品经理</option>
	            </select>
	<input type="submit" value="搜索">
</form>
<h2></h2>
<table class="table table-condensed">
	<thead>
		<tr>
             <th>管理员ID</th>
			<th>管理员名称</th>
			<th>管理员邮箱</th>
			<th>管理员级别</th>
            
            <th>管理员电话</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($res as $v)
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
            <td>{{$v->admin_email}}</td>
            <td>
			     @if($v->admin_level==1)
				    业务员
			     @else if($v->admin_level==2)
				   产品经理
				@endif
			</td>
            <td>{{$v->admin_tel}}</td>
            <td>
            <a href="{{url('/admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
            <a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-warning">删除</a>
            </td>
		</tr>
	    @endforeach
		<tr>
		   <td colspan='6'>{{$res->appends($query)->links()}}</td>
		</tr>
	</tbody>
	
</table>

</body>
</html>