@inject('tablePresenter','App\Presenters\Admin\TablePresenter')
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>菜单管理</title>


</head>
<body class="gray-bg">

<script>
var colums = [
    {!! $tablePresenter->jsCheckbox() !!}
    {!! $tablePresenter->jsColums('ID','id') !!}
    {!! $tablePresenter->jsColums('菜单名','name') !!}
    {!! $tablePresenter->jsColums('上级菜单','pname') !!}
    {!! $tablePresenter->jsEvents() !!}
];
</script>
@component('admin/components/table',$reponse)
@endcomponent
</body>
</html>
