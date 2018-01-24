@extends('admin.layer.welcome')

@section('content')
<div class="page-container">
	<div class="text-c">
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
         <span class="l">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
            <a class="btn btn-primary radius" data-title="添加文章" data-href="{{url('admin/writing_list/create')}}" onclick="Hui_admin_tab(this)" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加文章
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
				<th width="120">归属导航</th>
                <th width="75">文章标题</th>
				<th width="75">浏览量</th>
                <th width="75">文章作者</th>
                <th width="60">发布状态</th>
				<th width="120">操作</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $writing)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><input type="text" onchange="onchageorder(this,'{{$writing->id}}')" style="width: 20px;text-align: center;" value="{{$writing->orders}}"> </td>
				<td>{{$writing->id}}</td>
				<td>{{$writing->title}}</td>
                <td>{{$writing->name}}</td>
                <td>{{$writing->see}}</td>
                <td>{{$writing->author}}</td>
				<td class="td-status">
					@if($writing->writing_or == '待审核...')
					<span class="label label-success radius" style="cursor:pointer; background-color: red;" onclick="oar('{{$writing->id}}','{{$writing->writing_or}}')">{{$writing->writing_or}}</span></td>
					@else
					<span class="label label-success radius" style="cursor:pointer; " onclick="oar('{{$writing->id}}','{{$writing->writing_or}}')">{{$writing->writing_or}}</span></td>
					@endif
				<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" href="{{url('admin/writing_list/'.$writing->id.'/edit')}}"  title="编辑">
						<i class="Hui-iconfont">&#xe6df;</i></a>
					<a style="text-decoration:none" class="ml-5" onClick="article_del('{{url('admin/writing_list/')}}','{{$writing->id}}')" href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
				@endforeach

			</tbody>
		</table>
        <div>
            {{$data->links()}}
        </div>
	</div>
</div>
<style>
    .pagination li{
        background-color: #0e90d2;
    }
</style>
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
                "{{url('admin/writing/oar')}}",
                {
                    '_token':'{{csrf_token()}}',
                    'article_id':id,
                    'artile_or':sees,
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




	function onchageorder(obj,id) {
	    var artile_order = obj.valueOf();
        $.post(
            "{{url('admin/writing/onchageorder')}}",
            {
                '_token':'{{csrf_token()}}',
                'article_id':id,
                'artile_order':artile_order,
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
    }
	function onchageorder(obj,id){
		var artile_order = $(obj).val();
            $.post(
				"{{url('admin/writing/onchageorder')}}",
				{
					'_token':'{{csrf_token()}}',
					'article_id':id,
					'artile_order':artile_order,
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