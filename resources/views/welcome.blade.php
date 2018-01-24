<div class="col-sm-10">
@include('vendor.UEditor.head')
<!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain">

    </script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function(){
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
    </script>
</div> 