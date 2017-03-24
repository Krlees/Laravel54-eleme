<?php
namespace App\Services\Admin;

use App\Repositories\RoleRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\Admin\BaseService;

class UserService extends BaseService
{
    private $user;
    private $role;

    public function __construct(UserRepositoryEloquent $user, RoleRepositoryEloquent $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * AJAX 获取权限数据
     *
     * @param $param
     * @return array
     */
    public function ajaxUserList($param)
    {
        $where = [];
        if (isset($param['search'])) {
            $where = [
                ['name', 'like', "%{$param['search']}%"],
            ];
        }

        $results = $this->user->ajaxUserList($param['offset'], $param['limit'], $param['sort'], $param['order'], $where);

        return $results;
    }

    public function getAllRoles()
    {
        return $this->role->all(['id', 'display_name']);
    }

    /**
     * 获取权限 <select>
     */
    public function getUserSelects($id = 0)
    {
        return $this->user->getUserSelects($id)->toArray();
    }

    /**
     * 获取用户已有的角色
     * @param $id
     * @return array
     */
    public function getActiveRoles($id)
    {
        $activeRoles = $this->findByRoles($id);
        if (empty($activeRoles)) {
            return [];
        }

        return array_column($activeRoles, 'id'); //用户已有的角色
    }

    /**
     * 根据菜单ID查找数据
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function findById($id)
    {
        $data = $this->user->find($id);

        return $data ?: abort(404); // TODO替换正查找不到数据错误页面
    }

    public function findByRoles($id)
    {
        return $this->user->find($id)->roles()->get()->toArray();
    }

    /**
     * 创建数据
     */
    public function createData($param)
    {
        $data = $param['data'];
        $data['password'] = bcrypt($data['password']);
        $b = $this->user->create($data)->roles()->sync($param['role']);
        return $b ?: false;
    }

    /**
     * 更新数据
     *
     * @param $data
     * @return bool
     */
    public function updateData($id, $param)
    {
        $data = $param['data'];
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $b = $this->user->update($data, $id)->roles()->sync($param['role']);

        return $b ?: false;
    }

    /**
     * 删除数据
     *
     * @param array $ids
     */
    public function delData(array $ids)
    {
        if (empty($ids)) {
            return false;
        }

        $userModel = $this->user->model();
        $results = $userModel::whereIn('id', $ids)->delete();

        return $results;
    }

    /**
     * 递归数据
     *
     * @param $menus
     * @param int $pid
     * @return array|string
     */
    private function sortArr($menus, $pid = 0)
    {
        $arr = [];
        if (empty($menus)) {
            return '';
        }

        foreach ($menus as $key => $v) {
            if ($v['pid'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortArr($menus, $v['id']);
            }
        }
        return $arr;
    }


}