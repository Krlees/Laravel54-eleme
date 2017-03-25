<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Presenters\Admin\GoodsPresenter;
use App\Services\Admin\GoodsService;
use App\Traits\Admin\FormTraits;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{

    private $goods;
    public function __construct(GoodsService $goods)
    {
        $this->goods = $goods;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            // 获取商品列表
            $param = $this->cleanAjaxPageParam($request->all());
            $results = $this->goods->ajaxGoodsList($param);

            return $this->responseAjaxTable($results['total'],$results['rows']);

        } else {
            $reponse = $this->returnSearchFormat(url('admin/goods/index'),null, [
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
    public function add(Request $request, GoodsPresenter $presenter)
    {

        if ($request->isMethod('post')) {
            $results = $this->goods->createData($request->all());
            return $results ? $this->responseData(0,"操作成功",$results) : $this->responseData(200,"操作失败");
        } else {

            $this->returnFieldFormat('text', '商品名称', 'data[name]');
            $this->returnFieldFormat('text', '价格', 'data[price]');
            $this->returnFieldFormat('text', '市场价格', 'data[oldPrice]');
            $this->returnFieldFormat('text', '库存', 'data[storage]');
            $this->returnFieldFormat('textarea', '商品描述', 'data[description]');
            $this->returnFieldFormat('textarea', '详情', 'data[info]');
            $this->returnFieldFormat('checkbox', '标记', 'data[flag]', [
                [
                    'text' => '推荐',
                    'value' => '推荐',
                    'checked' => true,
                ],
                [
                    'text' => '新品',
                    'value' => '新品',
                ]
            ]);
            $this->returnFieldFormat('radio', '状态', 'data[status]', [
                [
                    'text' => '上架',
                    'value' => '2',
                    'checked' => true,
                ],
                [
                    'text' => '下架',
                    'value' => '0',
                ]
            ]);

            $classSelects = $this->goods->getAllClassSelects();
            $extendField = $presenter->classSelect($classSelects);

            $reponse = $this->returnFormFormat('添加商品', $this->formField);
            $reponse['extendField'] = $extendField;
            return view('admin/goods/add', compact('reponse'));
        }

    }

    public function edit($id, Request $request, GoodsPresenter $presenter)
    {
        if ($request->isMethod('post')) {
            $results = $this->goods->updateData($request->all(),$id);
            return $results ? $this->responseData(0,"操作成功",$results) : $this->responseData(200,"操作失败");
        } else {
            $info = $this->goods->findGoodsById($id);

            $this->returnFieldFormat('text', '商品名称', 'data[name]',$info['name']);
            $this->returnFieldFormat('text', '价格', 'data[price]',$info['price']);
            $this->returnFieldFormat('text', '市场价格', 'data[oldPrice]',$info['oldPrice']);
            $this->returnFieldFormat('text', '库存', 'data[storage]',$info['storage']);
            $this->returnFieldFormat('textarea', '商品描述', 'data[description]',$info['description']);
            $this->returnFieldFormat('textarea', '详情', 'data[info]',$info['info']);
            $this->returnFieldFormat('checkbox', '标记', 'data[flag][]', [
                [
                    'text' => '推荐',
                    'value' => '推荐',
                ],
                [
                    'text' => '新品',
                    'value' => '新品',
                ]
            ]);
            $this->returnFieldFormat('radio', '状态', 'data[status]', [
                [
                    'text' => '上架',
                    'value' => '2',
                ],
                [
                    'text' => '下架',
                    'value' => '0',
                ]
            ]);

            $classSelects = $this->goods->getAllClassSelects();
            $extendField = $presenter->classSelect($classSelects,$info['category']);

            $reponse = $this->returnFormFormat('添加商品', $this->formField);
            $reponse['extendField'] = $extendField;
            $reponse['info'] = $info;

            return view('admin/goods/edit', compact('reponse'));
        }
    }

    public function del(Request $request)
    {
        $ids = $request->input('ids');
        if( !is_array($ids) ){
            $ids = explode(",",$ids);
        }

        $results = $this->goods->delData($ids);
        return $results ? $this->responseData(0,"操作成功",$results) : $this->responseData(200,"操作失败");

    }


    /**
     * 返回子分类
     * @param int $pid
     */
    public function getSubClass($pid = 0)
    {
        $results = $this->goods->getSubClass($pid);

        return $results ? $this->responseData(0,"操作成功",$results) : $this->responseData(200,"操作失败");
    }




}