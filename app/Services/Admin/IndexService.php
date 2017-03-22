<?php
namespace App\Services\Admin;

use App\Repositories\MenuRepositoryEloquent;
use App\Repositories\PermissionRepositoryEloquent;

class IndexService extends BaseService
{
    private $menu;
    private $perm;

    public function __construct(MenuRepositoryEloquent $menu, PermissionRepositoryEloquent $perm)
    {
        $this->menu = $menu;
        $this->perm = $perm;
    }

    /**
     * 返回权限允许的菜单
     *
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPermMenu($user)
    {

        $menuData = $this->menu->getAllMenu();
        if ($user->is_super) {
            return $menuData;
        }

        $permArr = $this->perm->getPerm($user);
        $inArr = array_values(array_column($permArr, 'name'));
        foreach ($menuData as $k => $menu) {
            if (!in_array($menu->premission_name, $inArr)) {
                unset($menuData[$k]);
            }
        }

        return $menuData;
    }
}