@extends('admin.layer.welcome')

@section('content')
<div class="page-container">
	<div class="text-c">
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
         <span class="l">
		<button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
             <a class="btn btn-primary radius" data-title="分类管理" data-href="{{url('admin/article_list/create')}}" onclick="Hui_admin_tab(this)" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 添加分类
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
				<th width="120">分类名称</th>
				<th>分类标题</th>
				<th width="75">点击次数</th>
				<th width="60">发布状态</th>
				<th width="120">操作</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $article)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><input type="text" onchange="onchageorder(this,'{{$article->id}}')" style="width: 20px;text-align: center;" value="{{$article->article_order}}"> </td>
				<td>{{$article->id}}</td>
				<td>{{$article->_article_title}}</td>
				<td>{{$article->article_name}}</td>
				<td>{{$article->article_see}}</td>
				<td class="td-status">
					@if($article->article_or == '取消')
					<span class="label label-success radius" style="cursor:pointer; background-color: red;" onclick="oar('{{$article->id}}','{{$article->article_or}}')">{{$article->article_or}}</span></td>
					@else
					<span class="label label-success radius" style="cursor:pointer; " onclick="oar('{{$article->id}}','{{$article->article_or}}')">{{$article->article_or}}</span></td>
					@endif
				<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" href="{{url('admin/article_list/'.$article->id.'/edit')}}"  title="编辑">
						<i class="Hui-iconfont">&#xe6df;</i></a>
					<a style="text-decoration:none" class="ml-5" onClick="article_del('{{url('admin/article_list/')}}','{{$article->id}}')" href="javascript:;" title="删除">
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
                "{{url('admin/article/oar')}}",
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
            "{{url('admin/article/onchageorder')}}",
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
				"{{url('admin/article/onchageorder')}}",
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
    /*资讯-删除*/
    function article_del(url,id){

        layer.confirm('您确认要删除这个分类吗？', {
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
        });
    }

</script>
@endsection