<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 拜访会议展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-hover">
	<a class="btn btn-info" href="{{url('/meeting/create')}}">添加</a>
	<center><h2>拜访会议展示</h2></center>
	<form>
		<center>
		客户名称 : 
        <select name="mc" id="mc">
        	<option value='0'>请选择客户</option>
        	@foreach($yh as $f)
        	<option value="{{$f->client_id}}">{{$f->client_name}}</option>
        	@endforeach
        </select>&nbsp;&nbsp;
		访问人 : <input type="text" name='fwr' id='fwr' value="{{$sc['fwr']??''}}"  placeholder='访问人'>
		&nbsp;  <button class="btn btn-info" id='ss'>搜索</button>			
		</center>
	</form>
	<thead>
		<tr>
			<th><input type="checkbox" id='qx'></th>
			<th>id</th>
			<th>业务员名称</th>
			<th>客户名称</th>
			<th>访问人</th>
			<th>访问地址</th>
			<th>访问详情</th>
			<th>访问时间</th>
			<th>下次访问时间</th>						
			<th>操作
			&nbsp;
			<button id='scyx' class="btn btn-danger">删除已选</button>
			</th>
		</tr>
	</thead>
	<tbody id='th'>
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
	</tbody>
</table>

</body>
</html>

@verbatim
<script>
	$(function(){
	$("#scyx").hide();
//-------------------------------------------------------
      $(document).on('click','.pagination a',function(){
      	var dz=$(this).prop('href');
      	$.ajax({
      	  url:dz,
      	  type:'get',
      	  dateType:'json',
      	  success:function(yy){
      	  	$("[type='checkbox']").prop('checked',false);
      	  	$("#th").html(yy);
      	  }	
      	});
      	console.log(dz);
      	return false;
      });
//-------------------------------------------------------
      $(document).on('click','#ss',function(){
      	var mc=$("#mc>option:checked").val();
      	var fwr=$("#fwr").val();

      	$.ajax({
      	  url:'/meeting/index?mc='+mc+'&fwr='+fwr,
      	  type:'get',
      	  dateType:'text',
      	  success:function(yy){
      	  	$("#th").html(yy);
      	  }	
      	});
      	return false;
      });
//-------------------------------------------------------
     $(document).on('click','#sc',function(){
     var id=$(this).attr('wid');
     $.ajax({
       url:'/meeting/destroy',
       type:'get',
       dataType:'json',
       data:{'id':id},
       success:function(cy){
       	if(cy.a1==0){
       		location.reload();
       	}
       }	
     });   
     console.log(id);  	
     });     
//-------------------------------------------------------
      $(document).on('click','#qx',function(){
      	var sf=$(this).prop('checked');
      	$("#xz[type='checkbox']").prop('checked',sf);
        if(sf==true){
        	$("#scyx").show();
        }else{
        	$("#scyx").hide();
        }
      	console.log(sf);
      });
//-------------------------------------------------------
      $(document).on('click','#xz',function(){
      	var sl=0;
      	$("#xz[type='checkbox']").each(function(){
          if($(this).prop('checked')){
          	sl=sl+1;
          }
      	});
        if(sl>0){
        	$("#scyx").show();
        }else{
        	$("#scyx").hide();
        }
      });
//-------------------------------------------------------
      $(document).on('click','#scyx',function(){
      	var ids='';
      	$("#xz[type='checkbox']").each(function(){
           var sf=$(this).prop('checked');
           if(sf){
           	ids=ids+$(this).attr('xid')+',';
           }
      	}); 
        var cd=ids.length;
      	ids=ids.substr(0,cd-1);
         $.ajax({
           url:'/meeting/destroy',
           type:'get',
           dataType:'json',
           data:{'id':ids},
           success:function(cy){
           	if(cy.a1==0){
           		location.reload();
           	}
           }	
         }); 
      	console.log(ids);
      });
//-------------------------------------------------------
      $(document).on('click','#jg',function(){
      	var nm=$(this).attr('jnm');
      	var id=$(this).attr('jid');
      	var vl=$(this).text();
      	var sf=$(this).children().attr('nm');
        if(sf==undefined){
      	$(this).empty();
      	$(this).html("<input type='text' id='sq' nm="+nm+" nd="+id+" yvl="+vl+" value="+vl+">");
      	$("#sq").focus();
        }
      	console.log(nm,id,vl);
      });
//-------------------------------------------------------
       $(document).on('blur','#sq',function(){
       	 var ts=$(this);
       	 var id=$(this).attr('nd');
       	 var nm=$(this).attr('nm');
       	 var yvl=$(this).attr('yvl');
       	 var vl=$(this).val();
       	 if(nm=='meeting_address'){
           var zz2=/^[\u4e00-\u9fa5 \w]{2,50}$/;
           if(!zz2.test(vl)){
            $(this).parent().text(yvl);
            $(this).remove();           	
            console.log('访问地址中文数字字母下划线2到50位');
            return false;     
           }
       	 }
       	 if(nm=='meeting_desc'){
            var zz3=/^[\u4e00-\u9fa5 \w]{2,50}$/;
            if(!zz3.test(vl)){
             $(this).parent().text(yvl);
             $(this).remove();   	
             console.log('访问详情中文数字字母下划线2到50位');
             return false;    
            }
       	 }

       	 $.ajax({
       	   url:'/meeting/updates',
       	   type:'get',
       	   dataType:'json',
       	   data:{'id':id,'nm':nm,'vl':vl},
       	   success:function(tc){
       	   	if(tc.a1==0){
             ts.parent().text(vl);
             ts.remove();   
       	   	}else{
             ts.parent().text(yvl);
             ts.remove();          	   		
       	   	}
       	   	console.log(tc);
       	   }	
       	 });
       	 console.log(id,nm,yvl,vl);
       });
//-------------------------------------------------------
	});
</script>
@endverbatim
