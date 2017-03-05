<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>产品中心</title>

    @include('admin/common/css')

</head>
<body class="gray-bg">

@component('admin/components/table',
    [
        'isForm'=>true,
        'formField' => [
            [
                'title' => '名称',
                'name'  => 'kr',
                'type' => 'text',
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],[
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select'
            ],
        ],
    ]
)
@endcomponent
</body>
</html>
