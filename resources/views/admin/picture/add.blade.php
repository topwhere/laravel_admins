@extends('admin.layer.welcome')
@section('content')
<article class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20">

        @if(count($errors)>0)
            <span class="l">
                    <p style="color: red;">{{$errors}}!</p>
            </span>
        @endif
    </div>
	<form class="form form-horizontal" action="{{url('admin/picture')}}" method="post" enctype="multipart/form-data" id="form-article-add">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>归属导航：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="pic_title" class="select">
				    @foreach($data as $v)
                        <option value="{{$v->article_title}}">{{$v->_article_title}}</option>
                    @endforeach

                </select>
				</span> </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="articletitle" name="pic_name">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">请选择图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input name="pic_src" type="file" multiple="true">

            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">图片链接</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="例：www.baidu.com" id="author" name="pic_url">
            </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="articlesort" name="pic_orders">
			</div>
		</div>

        <input type="hidden" value="待审核..." name="pic_or">

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>

    </form>
</article>

				@include('admin.common.footer')
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/lib/webuploader/0.1.5/webuploader.min.js')}}"></script>


@endsection
				<!--/请在上方写此页面业务相关的脚本-->
