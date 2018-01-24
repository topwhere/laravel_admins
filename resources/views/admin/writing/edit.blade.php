@extends('admin.layer.welcome')
@section('content')
    @include('vendor.UEditor.head')
<article class="page-container">
	<form class="form form-horizontal" action="{{url('admin/writing_list/'.$data->id.'')}}" method="post" id="form-article-add">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>归属导航：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="title" class="select">
                        <option value="{{$data->title}}">{{$data->title}}</option>


                </select>
				</span> </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data->name}}" placeholder="" id="articletitle" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data->orders}}" placeholder="0" id="articlesort" name="orders">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data->tal}}" placeholder="" id="keywords" name="tal">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章作者：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$data->author}}" placeholder="" id="author" name="author">
			</div>
		</div>
        <input type="hidden" value="待审核..." name="writing_or">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
                <script id="container" name="content" type="text/plain">
                    {!! html_entity_decode($data->content) !!}
                </script>

            </div>
                </div>
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                        <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </div>
        </div>
    </form>
</article>

				@include('admin.common.footer')

                <!--请在下方写此页面业务相关的脚本-->
                <script type="text/javascript" src="{{asset('resources/views/admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
				<script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
				<script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
				<script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
				<script type="text/javascript" src="{{asset('resources/views/admin/lib/webuploader/0.1.5/webuploader.min.js')}}"></script>
                <script type="text/javascript" src="{{asset('public/laravel-u-editor/ueditor.config.js')}}"></script>
                <script type="text/javascript" src="{{asset('public/laravel-u-editor/ueditor.all.js')}}"> </script>
                <script type="text/javascript" src="{{asset('public/laravel-u-editor/ueditor.parse')}}"></script>
				<script type="text/javascript">
                    $(function(){
                        $('.skin-minimal input').iCheck({
                            checkboxClass: 'icheckbox-blue',
                            radioClass: 'iradio-blue',
                            increaseArea: '20%'
                        });
                        //表单验证
                        $("#form-article-add").validate({
                            rules:{
                                title:{
                                    required:true,
                                },
                                name:{
                                    required:true,
                                },
                                orders:{
                                    required:true,
                                },
                                tal:{
                                    required:true,
                                },
                                author:{
                                    required:true,
                                },
                                content:{
                                    required:true,
                                },

                            },

                        });


                        var ue = UE.getEditor('container');
                        ue.ready(function(){
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });

                    });
				</script>

@endsection
				<!--/请在上方写此页面业务相关的脚本-->
