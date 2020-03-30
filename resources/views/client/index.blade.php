<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 边框表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-bordered">
	<a style="float:right" href="{{url('client/create')}}" class="btn btn-default">添加</a>
		商品名称<input type="text" name="client_name" value="{{$query['name']??''}}">
		<input type="button" id="sou" value="搜索">
	<thead>
		<tr>
		<th>客户id</th>
      	<th>客户姓名</th>
      	<th>会员</th>
      	<th>客户来源</th>
      	<th>业务员</th>
      	<th>客户电话</th>
      	<th>客户手机号</th>
      	<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($arr as $k=>$v)
		<tr>
		<th>{{$v->client_id}}</th>
      	<th>{{$v->client_name}}</th>
      	<th>{{$v->client_rank=='1'?"普通":"非会员"}}</th>
      	<th>{{$v->sale_root}}</th>
     	<th>{{$v->sale_name}}</th>
      	<th>{{$v->client_phone}}</th>
      	<th>{{$v->client_tel}}</th>
		<td>
			<a href="{{url('client/edit'.$v->client_id)}}" class="btn btn-success">编辑</a>
			<a href="{{url('client/destroy'.$v->client_id)}}" class="btn btn-success">删除</a>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$arr->appends($query)->links()}}
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
  $(function(){
    $(document).on("click",".pagination a",function(){
      var url=$(this).attr('href');
      $.get(url,function(msg){
        $("tbody").html(msg);
      })
      return false;
    });
  });
  $("#sou").click(function(){
  	var client_name=$("input[name='client_name']").val();
  	$.ajax({
  		url: 'index'+client_name,
  		type: 'get',
  		dataType: 'text',
  		success:function(msg){
        $("tbody").html(msg);
  		}
  	})
  });
</script>

