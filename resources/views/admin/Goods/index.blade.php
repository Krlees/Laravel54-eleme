<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>产品中心</title>


</head>
<body class="gray-bg">
<script>
// 必须定义要显示的字段
var colums = [
    {!! createCheckbox() !!}
    {!! createColums('ID','id') !!}
    {!! createEvents() !!}
];
</script>

@component('admin/components/table',$reponse)
@endcomponent
</body>
</html>
