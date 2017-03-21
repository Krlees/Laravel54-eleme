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

	public function model()
    {
        return Permission::class;
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
    public function getPermSelects()
    {
        return $this->permission->getPermSelects();
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
        $data['pid'] = 0;
        $b = $this->premission->create($data);
        return $b ?: false;
    }




}