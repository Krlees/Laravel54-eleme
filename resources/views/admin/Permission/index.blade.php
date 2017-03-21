@inject('tablePresenter','App\Presenters\Admin\TablePresenter')
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>权限管理</title>

    <script>
        var colums = [
            {!! $tablePresenter->jsCheckbox() !!}
            {!! $tablePresenter->jsColums('ID','id','true') !!}
            {!! $tablePresenter->jsColums('显示名称','display_name') !!}
            {!! $tablePresenter->jsColums('路由名','name') !!}
            {!! $tablePresenter->jsColums('icon图标','icon') !!}
            {!! $tablePresenter->jsColums('说明','description') !!}
            {!! $tablePresenter->jsEvents() !!}
        ];
    </script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    @component('admin/components/table',$reponse)
    @endcomponent
</div>

</body>
</html>
