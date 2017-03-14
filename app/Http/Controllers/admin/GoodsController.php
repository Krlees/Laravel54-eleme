<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepositoryEloquent;
use Illuminate\Http\Request;

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
        print_R($res);
        exit;
    }

    public function getList()
    {

    }

    /**
     * 添加商品
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {

        if ($request->isMethod('post')) {
            return $this->reponseData();
        } else {
            $class_id = 2;
            $data = $this->goods->find(1);
            $class = [
                [
                    'text' => '饮品类',
                    'value' => '123123',
                ],
                [
                    'text' => '小吃类',
                    'value' => '444444',
                ],
            ];
            foreach ($class as $k => $v) {
                if ($v['value'] == $class_id) {
                    $class[$k]['cgithecked'] = 'true';
                }
            }

            $formField = [
//                returnformField('email', '性别', 'sex', '', ['required']),
//                returnformField('text', '手机号码', 'phone', '', [
//                    'data-mask="99-999999999"',
//                    'aria-required="true"',
//                    'aria-invalid="true"',
//                    'datatype' => '*'
//                ], '13-799999999'),
//                returnformField('text', '密码', 'password','',['datatype'=>'*']),
                returnformField('name','商品名称','name'),

                returnformField('file', '图片', 'imgs'),
                returnformField('checkbox', '标记', 'flag', [
                    [
                        'text' => '推荐',
                        'value' => '推荐',
                        'checked' => true,
                    ],
                    [
                        'text' => '新品',
                        'value' => '新品',
                    ]
                ]),
                returnformField('radio', '状态', 'status', [
                    [
                        'text' => '上架',
                        'value' => '2',
                        'checked' => true,
                    ],
                    [
                        'text' => '下架',
                        'value' => '0',
                    ]
                ]),
                returnformField('select', '商品分类', 'class_id', $class),

            ];
            return view('admin/goods/add', $this->reponseForm('添加商品', $formField));
        }

    }


    public function edit()
    {


    }


}