<?php
namespace App\Services\Admin;
use App\Repositories\MenuRepositoryEloquent;
use App\Services\Admin\BaseService;
use Exception,DB;

class MenuService extends BaseService
{
	private $menu;

	public function __construct(MenuRepositoryEloquent $menu)
	{
		$this->menu = $menu;
	}

	public function getTopMenu()
    {
        return $this->menu->getTopMenu();
    }

    public function getAllMenu()
    {
        return $this->menu->getAllMenu();
    }

    public function ajaxMenuList($offset, $limit)
    {
        return $this->menu->ajaxMenuList($offset, $limit);
    }

    /**
     * 创建数据
     */
    public function createData($data)
    {
        $data['pid'] = 0;
        $b = $this->menu->create($data);

        return $b ?: false;
    }




}