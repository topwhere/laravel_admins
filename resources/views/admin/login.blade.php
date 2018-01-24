<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <meta name="keywords" content="topwhere框架">
  <meta name="description" content="topwhere为轻量级的网站后台管理系统模版。">
  <title>首页</title>
  <link rel="stylesheet" href="{{asset('resources/org/common/layui/css/layui.css')}}">
  <link rel="stylesheet" href="{{asset('resources/org/icon/1.0.8/iconfont.css')}}">
  <link rel="stylesheet" href="{{asset('resources/org/common/css/sccl.css')}}">
</head>
<body class="login-bg">
<div class="login-box">
  <header>
    <h1>框架后台管理系统</h1>
  </header>
  <p style="color: #aee1fb;">
    {{session('msg')}}
  </p>
  <div class="login-main">
    <form action="{{url('admin/login')}}" class="layui-form" method="post">
      {{csrf_field()}}
      <div class="layui-form-item">
        <label class="login-icon">
          <i class="Hui-iconfont">&#xe60d;</i>
        </label>
        <input type="text" name="username" lay-verify="userName" autocomplete="off" placeholder="这里输入登录名" class="layui-input">
      </div>
      <div class="layui-form-item">
        <label class="login-icon">
          <i class="Hui-iconfont">&#xe605;</i>
        </label>
        <input type="password" name="userpass" lay-verify="password" autocomplete="off" placeholder="这里输入密码" class="layui-input">
      </div>
      <div class="layui-form-item">
        <label class="login-icon">
          <i class="Hui-iconfont">&#xe615;</i>
        </label>
        <input type="text" name="yzm" lay-verify="yzm" autocomplete="off" placeholder="请输入验证码" class="layui-input yzm">
        <img src="{{url('admin/code')}}" class="yzms" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
      </div>
      <div class="layui-form-item">
        <div class="pull-left login-remember">
          <label>记住帐号？</label>

          <input type="checkbox" name="rememberMe" value="true" lay-skin="switch" title="记住帐号"><div class="layui-unselect layui-form-switch"><i></i></div>
        </div>
        <div class="pull-right">
          <button class="layui-btn layui-btn-primary" lay-submit="" lay-filter="login">
            <i class="Hui-iconfont">&#xe6a8;</i>  登录
          </button>
        </div>
        <div class="clear"></div>
      </div>
    </form>
  </div>



  <footer style="margin: 200px auto;">
    <p>www.topwhere.cn</p>
  </footer>


</div>
<script src="{{asset('resources/org/common/layui/layui.js')}}"></script>
<script>
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer,
            $ = layui.jquery,
            form = layui.form();

        form.verify({
            userName: function (value) {
                if (value === '')
                    return '请输入用户名';
            },
            password: function (value) {
                if (value === '')
                    return '请输入密码';
            },
            yzm: function (value) {
                if (value === '')
                    return '请输入密码';
            }
        });
    });

</script>
</body>
</html>
