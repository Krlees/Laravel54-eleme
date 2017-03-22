<?php
namespace App\Services\Admin;

use App\Repositories\UserRepositoryEloquent;
use App\Services\Admin\BaseService;

class UserService extends BaseService
{
    private $user;

    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
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

    /**
     * 获取权限 <select>
     */
    public function getUserSelects($id = 0)
    {
        return $this->user->getUserSelects($id)->toArray();
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

    /**
     * 创建数据
     */
    public function createData($data)
    {
        $data['password'] = bcrypt($data['password']);
        $b = $this->user->create($data);
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
        if( $data['password'] ) {
            $data['password'] = bcrypt($data['password']);
        }
        else {
            unset($data['password']);
        }

        $b = $this->user->update($data, $id);

        return $b ?: false;
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