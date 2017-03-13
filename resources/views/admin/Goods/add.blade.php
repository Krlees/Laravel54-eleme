<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$formTitle}}</title>
</head>
<body class="gray-bg">
@component('admin/components/form',compact('formTitle','formUrl','formField')))
@endcomponent
</body>
</html>
