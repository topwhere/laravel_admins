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
           <p style="color: red;">{{$error}}!</p>
       @endif
   </span>
@endif
</div>
<form class="form form-horizontal" action="{{url('admin/article_list')}}" method="post" id="form-article-add">
{{csrf_field()}}
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>父级分类：</label>
   <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
       <select name="article_fid" class="select">
           <option value="0">默认顶级栏目</option>
           @foreach($data as $v)
           <option value="{{$v->id}}">{{$v->article_title}}</option>
           @endforeach
       </select>
       </span> </div>
</div>
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
   <div class="formControls col-xs-8 col-sm-9">
       <input type="text" class="input-text" value="" placeholder="" id="articletitle" name="article_title">
   </div>
</div>
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类标题：</label>
   <div class="formControls col-xs-8 col-sm-9">
       <input type="text" class="input-text" value="" placeholder="" id="articletitle" name="article_name">
   </div>
</div>
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>发布状态：</label>
   <div class="formControls col-xs-8 col-sm-9">
       <select name="article_or">
           是否发布？
           <option value="发布">发布</option>
           <option value="隐藏">隐藏</option>
       </select>
   </div>
</div>
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2">关键词：</label>
   <div class="formControls col-xs-8 col-sm-9">
       <input type="text" class="input-text" value="" placeholder="" id="keywords" name="article_description">
   </div>
</div>
<div class="row cl">
   <label class="form-label col-xs-4 col-sm-2">排序值：</label>
   <div class="formControls col-xs-8 col-sm-9">
       <input type="text" class="input-text" value="0" style="width: 70px; text-align: center;" placeholder="" id="articlesort" name="article_order">
   </div>
</div>
       <div class="row cl"><div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
           <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
       <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
       </div>
</div>
</form>
</article>

<script type="text/javascript" src="{{asset('resources/views/admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/views/admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
@endsection