@foreach($zs as $c)	
		<tr>
			<th><input type="checkbox" id='xz' xid="{{$c->meeting_id}}"></th>
			<th>{{$c->meeting_id}}</th>
			<th>{{$c->sale_name}}</th>
			<th>{{$c->client_name}}</th>
			<th>{{$c->meeting_man}}</th>
			<th id='jg' jnm='meeting_address' jid={{$c->meeting_id}}>{{$c->meeting_address}}</th>
			<th id='jg' jnm='meeting_desc' jid={{$c->meeting_id}}>{{$c->meeting_desc}}</th>			
			<th>{{date( "Y-n-j", + $c['add_time'])}}</th>
			<th>{{$c->meeting_time}}</th>
			<th>
				<a href="{{url('/meeting/edit?id='.$c->meeting_id)}}" class="btn btn-info">修改</a>
				<a href="javascript:void(0)" id='sc' wid="{{$c->meeting_id}}" class="btn btn-danger">删除</a>				
			</th>			
		</tr>
    @endforeach
        <tr>
        	<th colspan="15">
			<center>
{{$zs->appends($sc)->links()}}			
			</center>        		
        	</th>
        </tr>