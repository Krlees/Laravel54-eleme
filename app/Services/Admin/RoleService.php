<?php
namespace App\Services\Admin;
use App\Repositories\RoleRepositoryEloquent;
use App\Services\Admin\BaseService;

class RoleService extends BaseService
{
	private $role;

	public function __construct(RoleRepositoryEloquent $role)
	{
		$this->role = $role;
	}

    /**
     * AJAX 获取权限数据
     *
     * @param $param
     * @return array
     */
    public function ajaxRoleList($param)
    {
        $where = [];
        if( isset($param['search'])){
            $where = [
                ['name','like',"%{$param['search']}%",'and'],
                ['display_name','like',"%{$param['search']}%",'or']
            ];
        }

        $results =  $this->role->ajaxRoleList($param['offset'],$param['limit'],$param['sort'],$param['order'], $where);
        
        return $results;
    }

    /**
     * 获取权限 <select>
     */
    public function getRoleSelects($id=0)
    {
        return $this->role->getRoleSelects($id)->toArray();
    }

    /**
     * 根据菜单ID查找数据
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function findById($id)
    {
        $data = $this->role->find($id);

        return $data ?: abort(404); // TODO替换正查找不到数据错误页面
    }

    /**
     * 创建数据
     */
    public function createData($data)
    {
        $b = $this->role->create($data);
        return $b ?: false;
    }

    /**
     * 更新数据
     *
     * @param $data
     * @return bool
     */
    public function updateData($id, $data)
    {
        $RoleModel = $this->role->model();
        $b = $RoleModel::where('id',$id)->update($data);

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