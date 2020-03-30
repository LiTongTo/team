@foreach($arr as $k=>$v)
		<tr>
		<th>{{$v->client_id}}</th>
      	<th>{{$v->client_name}}</th>
      	<th>{{$v->client_rank=='1'?"会员":"普通"}}</th>
      	<th>{{$v->client_root}}</th>
     	<th>{{$v->sale_name}}</th>
      	<th>{{$v->client_phone}}</th>
      	<th>{{$v->client_tel}}</th>
		<td>
			<a href="{{url('client/edit'.$v->client_id)}}" class="btn btn-success">编辑</a>
			<a href="{{url('client/destroy'.$v->client_id)}}" class="btn btn-success">删除</a>
		</td>
		</tr>
		@endforeach
{{$arr->links()}}