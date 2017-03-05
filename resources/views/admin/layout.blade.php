<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>@yield('title') - Krlee后台管理系统</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">

    @include('admin/common/css')

    @yield('css')

</head>
<body class="gray-bg">

@section('content')
@show

<script src="{{asset('admin/js/jquery.min.js?v=2.1.4')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js?v=3.3.6')}}"></script>
<script src="{{asset('admin/js/content.js?v=1.0.0')}}"></script>
<script src="{{asset('admin/js/plugins/layer/layer.min.js')}}"></script>

@include('admin/common/js')

@yield('js')

</body>
</html>


