@extends('admin.layer.welcome')
@section('content')
<div class="page-container">


  <div class="mt-20">
    <div class="pd-20">
      <form class="Huiform" action="{{url('admin/pass')}}" method="post">
        {{csrf_field()}}



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
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
          <tbody>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 原密码：</th>
              <td><input type="password" style="width:500px" class="input-text" value="" id="teacher-new-password2" name="password_o">&emsp;;<span class="text-r">请输入原密码</span></td>
          </tr>
          <tr>
            <th width="100" class="text-r"><span class="c-red">*</span>新密码：</th>
            <td><input type="password" style="width:500px" class="input-text" value="" id="teacher-new-password" name="password">&emsp;<span class="text-r">新密码6-20位</span></td>
          </tr>
          <tr>
            <th class="text-r"><span class="c-red">*</span> 确认密码：</th>
            <td><input type="password" style="width:500px" class="input-text" value="" id="teacher-new-password2" name="password_confirmation">&emsp;<span class="text-r">再次输入</span></td>
          </tr>
          <tr>
            <th></th>
            <td><button class="btn btn-success radius" type="submit"><i class="icon-ok"></i> 确定</button></td>
          </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>
@endsection