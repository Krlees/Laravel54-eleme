<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$reponse['formTitle']}}</title>
</head>
<body class="gray-bg">
@component('admin/components/form',$reponse)
@endcomponent
@include('admin.user.modal')
<script>
    $(function () {
        // 关闭modal清空内容
        $(".modal").on("hidden.bs.modal",function(e){
            $(this).removeData("bs.modal");
        });
    });
</script>
</body>
</html>
