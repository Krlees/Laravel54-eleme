<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Repositories\GoodsRepositoryEloquent;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{
    private $goods;

    public function __construct(GoodsRepositoryEloquent $goods)
    {
        $this->goods = $goods;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $offset = $request->input('offset');
            $limit = $request->input('limit', 10);

            // 获取商品列表
            $results = $this->goods->ajaxGoodsList($offset, $limit);

            return $this->reponseDataTabel($results['total'], $results['rows']);

        } else {
            $reponse = $this->reponseTable(url('admin/goods/index'), f, [
                'addUrl' => url('admin/goods/add'),
                'editUrl' => url('admin/goods/edit'),
                'removeUrl' => url('admin/goods/del'),
                'autoSearch' => true
            ]);

            return view('admin/goods/index', compact('reponse'));
        }

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

            $formField = [
                returnformField('text', '商品名称', 'name'),
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
                returnformField('select', '商品分类', 'class_id', $this->getClassSelect(1)),
            ];

            $reponse = $this->reponseForm('添加商品', $formField);
            return view('admin/goods/add', compact('reponse'));
        }

    }


    public function edit()
    {

    }

    public function del(Request $request)
    {
        $ids = $request->input('ids');
        if( !is_array($ids) ){
            $ids = explode(",",$ids);
        }

        return $this->reponseData(0,'', $ids);
    }

    /**
     * 返回已处理好的【select框】商品分类
     *
     * @param bool $class_id 分类id,为0则不帅选
     * @return Array
     */
    private function getClassSelect($class_id = 0)
    {
        $class_data = $this->goods->getGoodsClass()->toArray();

        return returnCleanSelect($class_data, 'name', 'id', $class_id);
    }


}