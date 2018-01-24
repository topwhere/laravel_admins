@extends('admin.layer.welcome')

@section('content')
<div class="page-container">
	<div class="text-c">
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
         <span class="l">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
            <a class="btn btn-primary radius" data-title="添加图片" data-href="{{url('admin/picture/create')}}" onclick="Hui_admin_tab(this)" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加图片
            </a>
        </span>
        <span class="r">共有数据：<strong>{{$numbers}}</strong> 条</span>
    </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">排序</th>
				<th width="80">ID</th>
				<th width="120">归属分类</th>
                <th width="75">图片名称</th>
				<th width="150">图片展示</th>
                <th width="75">图片链接</th>
                <th width="60">发布状态</th>
				<th width="120">操作</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $picture)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><input type="text" onchange="onchageorder(this,'{{$picture->id}}')" style="width: 20px;text-align: center;" value="{{$picture->pic_orders}}"> </td>
				<td>{{$picture->id}}</td>
				<td>{{$picture->pic_title}}</td>
                <td>{{$picture->pic_name}}</td>
                <td height="100" class="images">
                    <a href="{{url('admin/picture/'.$picture->id.'/edit')}}" class="images">
                        <img src="{{url('public/uploads')}}/{{$picture->pic_src}}" width="150">
                    </a>
                </td>
                <td>{{$picture->pic_url}}</td>
				<td class="td-status">
					@if($picture->pic_or == '待审核...')
					<span class="label label-success radius" style="cursor:pointer; background-color: red;" onclick="oar('{{$picture->id}}','{{$picture->pic_or}}')">{{$picture->pic_or}}</span></td>
					@else
					<span class="label label-success radius" style="cursor:pointer; " onclick="oar('{{$picture->id}}','{{$picture->pic_or}}')">{{$picture->pic_or}}</span></td>
					@endif
				<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" href="{{url('admin/picture/'.$picture->id.'/edit')}}"  title="编辑">
						<i class="Hui-iconfont">&#xe6df;</i></a>
					<a style="text-decoration:none" class="ml-5" onClick="article_del('{{url('admin/picture/')}}','{{$picture->id}}')" href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
				@endforeach

			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('resources/views/lib/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/org/layer/layer.js')}}"></script>


<script type="text/javascript">
    function oar(id,sees) {
        layer.confirm('是否修改上架？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            $.post(
                "{{url('admin/picture/oar')}}",
                {
                    '_token':'{{csrf_token()}}',
                    'pic_id':id,
                    'pic_or':sees,
                },
                function(data){
                    if(data.staus == 0){
                        location.replace(location.href);
                        layer.alert(data.msg,
                            {
                                icon: 6,
                                skin: 'layer-ext-moon'
                            })
                    }else{
                        layer.alert('data.msg',
                            {
                                icon: 5,
                                skin: 'layer-ext-moon'
                            })
                    }
                }
            );
        });

    }




	function onchageorder(obj,id){
		var pic_order = $(obj).val();
            $.post(
				"{{url('admin/picture/onchageorder')}}",
				{
					'_token':'{{csrf_token()}}',
					'pic_id':id,
					'pic_order':pic_order,
				},
				function(data){
					if(data.staus == 0){
                    	layer.alert(data.msg,
						{
							icon: 6,
							skin: 'layer-ext-moon'
						 })
					}else{
                    	layer.alert('data.msg',
							{
							    icon: 5,
								skin: 'layer-ext-moon'
                    		})
					}
				}
		    );


	};
    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading":false,
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
        ]
    });

    /*资讯-添加*/
    function article_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*资讯-删除*/
    function article_del(url,id){

        layer.confirm('您确认要删除这篇文章吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
				$.post(url+'/'+id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                    if(data.staus == 0){
                        location.replace(location.href);
                        layer.alert(data.msg, {
                            icon: 5,
                            skin: 'layer-ext-moon'
                        })
                    }else{
                        layer.alert(data.msg, {
                            icon: 6,
                            skin: 'layer-ext-moon'
                        })
                    }
				})
        }, function(){
            layer.msg('返回原页面...', {
                time: 20000, //20s后自动关闭
            });
        });
    }

</script>
@endsection