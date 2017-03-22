<?php
namespace App\Services\Admin;
use App\Models\Permission;
use App\Repositories\PermissionRepositoryEloquent;
use App\Services\Admin\BaseService;

class PermissionService extends BaseService
{
	private $permission;

	public function __construct(PermissionRepositoryEloquent $permission)
	{
		$this->permission = $permission;
	}

    public function ajaxPermList($param)
    {
        $where = [];
        if( isset($param['search'])){
            $where['name'] = $param['search'];
        }

        return $this->permission->ajaxPermList($param['offset'],$param['limit'],$param['sort'],$param['order'], $where);
    }

    /**
     * 获取权限 <select>
     */
    public function getPermSelects($id=0)
    {
        return $this->permission->getPermSelects($id)->toArray();
    }

    /**
     * 根据菜单ID查找数据
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function findById($id)
    {
        $data = $this->premission->find($id);

        return $data ?: abort(404); // TODO替换正查找不到数据错误页面
    }

    /**
     * 创建数据
     */
    public function createData($data)
    {
        $permModel = $this->permission->model();
        $b = $permModel::create($data);
        return $b ?: false;
    }

    /**
     * 递归数据
     *
     * @param $menus
     * @param int $pid
     * @return array|string
     */
    private function sortArr($menus,$pid=0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }
        foreach ($menus as $key => $v) {
            if ($v['pid'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortArr($menus,$v['id']);
            }
        }
        return $arr;
    }




}