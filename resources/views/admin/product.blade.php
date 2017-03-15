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
        'searchUrl' => '',
        'isForm'=>true,
        'searchField' => [
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'select',
                'value' => [
                    [
                        'text' => '男',
                        'value' => '男',
                        'checked' => false,
                    ],
                    [
                        'text' => '女',
                        'value' => '女',
                        'checked' => true,
                    ]
                ],
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'checkbox',
                'value' => [
                    [
                        'text' => '男',
                        'value' => '男',
                        'checked' => false,
                    ],
                    [
                        'text' => '女',
                        'value' => '女',
                        'checked' => true,
                    ]
                ],
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'text',
                'value'=>'男'
            ]
        ],
    ]
)
@endcomponent
</body>
</html>
