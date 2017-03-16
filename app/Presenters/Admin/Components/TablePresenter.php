<?php
namespace App\Presenters\Admin\Components;

class TablePresenter
{
    /**
     * 返回创建操作视图
     *
     * @param $createUrl    需要新建操作的url
     * @return string|void
     */
    public function createAction($createUrl)
    {
        if (isset($createUrl{0})) {
            return <<<Eof
<a href="{$createUrl}" class="btn btn-outline btn-default" title="新建">
    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
</a>
Eof;
        }

        return;

    }

    public function removeAction($bool)
    {

    }

}