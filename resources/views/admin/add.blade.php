<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>产品中心</title>

    @include('admin/common/css')

</head>
<body class="gray-bg">

@component('admin/components/form',
    [
        'formTitle'=>'添加商品',
        'formField' => [
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'email',
                'value'=>'',
                'options' => ['required'],
            ],
            [
                'title' => '手机号码',
                'name'  => 'sex',
                'type'  => 'text',
                'value' => '',
                'tips'  => '13-799999999',
                'options'=>[
                    'data-mask="99-999999999"',
                    'aria-required="true"',
                    'aria-invalid="true"',
                ]
            ],
            [
                'title' => '密码',
                'name'  => 'password',
                'type' => 'password',
                'value'=>'',
                'options' => [],
            ],
            [
                'title' => '确认密码',
                'name'  => 'confirm_password',
                'type' => 'password',
                'value'=>'',
                'options' => [],
            ],
            [
                'title' => '图片',
                'name'  => 'imgs',
                'type' => 'file',
                'value'=>'',
                'options' => [],
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'checkbox',
                'value'=>[
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
                'options' => [],
            ],
            [
                'title' => '性别',
                'name'  => 'sex',
                'type' => 'radio',
                'value'=>[
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
                'options' => [],
            ],
        ],
    ]
)
@endcomponent
</body>
</html>
