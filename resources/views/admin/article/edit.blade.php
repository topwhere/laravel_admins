@extends('admin.layer.welcome')
@section('content')
<article class="page-container">

    <div class="cl pd-5 bg-1 bk-gray mt-20">

        @if(count($errors)>0)
            <span class="l">
              @if(is_object($errors))
                    @foreach($errors ->all() as $error)
                        <p style="color: rgba(125,67,111,0.57);">
                    {{$error}}!
                  </p>
                    @endforeach
                @else
                    <p style="color: red;">{{$errors}}!</p>
                @endif
            </span>
        @endif
    </div>
	<form class="form form-horizontal" action="{{url('admin/article_list/'.$field->id.'')}}" method="post" id="form-article-add">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>父级分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="article_fid" class="select">
					<option value="0">默认顶级栏目</option>
                    @foreach($data as $v)
					<option value="{{$v->id}}" @if($v->id == $field->article_fid) selected @endif>{{$v->article_title}}</option>
				    @endforeach
                </select>
				</span> </div>
        </div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$field->article_title}}" placeholder="" id="articletitle" name="article_title">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$field->article_name}}" placeholder="" id="articletitle" name="article_name">
            </div>
        </div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$field->article_description}}" placeholder="" id="keywords" name="article_description">
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">排序值：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$field->article_order}}" style="width: 70px; text-align: center;" placeholder="" id="articlesort" name="article_order">
            </div>
        </div>
                <div class="row cl"><div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                    </div>
        </div>
    </form>
</article>

    @include('admin.common.footer')
@endsection