<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepositoryEloquent;
use Illuminate\Support\Facades\Request;

class GoodsController extends Controller
{
    private $goods;

    public function __construct(GoodsRepositoryEloquent $goods)
    {
        $this->goods = $goods;
    }

    public function index()
    {
        return view('admin/product');
    }

    public function uploads(Request $request)
    {
        $res = $request->all();
        print_R($res);exit;
    }

    public function getList()
    {

    }

    public function add()
    {

        $data = $this->goods->find(1);
        var_dump($data);exit;

        $formTitle = '添加商品';
        $formField = [
            [
                'title' => '性别',
                'name' => 'sex',
                'type' => 'email',
                'value' => '',
                'options' => ['required'],
            ],
            [
                'title' => '手机号码',
                'name' => 'sex',
                'type' => 'text',
                'value' => '',
                'tips' => '13-799999999',
                'options' => [
                    'data-mask="99-999999999"',
                    'aria-required="true"',
                    'aria-invalid="true"',
                ]
            ],
            [
                'title' => '密码',
                'name' => 'password',
                'type' => 'password',
                'value' => '',
                'options' => [],
            ],
            [
                'title' => '确认密码',
                'name' => 'confirm_password',
                'type' => 'password',
                'value' => '',
                'options' => [],
            ],
            [
                'title' => '图片',
                'name' => 'imgs',
                'type' => 'file',
                'value' => '',
                'options' => [],
            ],
            [
                'title' => '性别',
                'name' => 'sex',
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
                'options' => [],
            ],
            [
                'title' => '性别',
                'name' => 'sex',
                'type' => 'radio',
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
                'options' => [],
            ],
        ];

        return view('admin/add',$this->reponseForm($formTitle, $formField));
    }

}