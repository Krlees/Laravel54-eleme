<?php
namespace App\Repositories;

use App\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepositoryEloquent extends BaseRepository
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function model()
    {
        // TODO: Implement model() method.
        return Role::class;
    }

    /**
     * ajax获取权限数据
     *
     * @param $offset
     * @param $limit
     * @param bool $sort
     * @param $order
     * @param array $where
     * @return array
     */
    public function ajaxRoleList($offset, $limit, $sort=false, $order, $where = [])
    {
        $sort = $sort ?: $this->role->getKeyName();

        $rows = $this->role->where($where)->orderBy($sort,$order)->offset($offset)->limit($limit)->get()->toArray();

        $total = $this->role->where($where)->count();

        return compact('rows', 'total');
    }

    public function getroleSelects($id)
    {
        return $this->role->where(['pid'=>$id])->get(['name','pid','id','display_name']);
    }

    /**
     * 返回用户的权限
     *
     * @param $user
     * @return Array
     */
    public function getrole($user)
    {
        $roles = Role::find($user->id);
        if( !$roles){
            return [];
        }
        $roles = $roles->roles()->get(['name'])->toArray();

        return $roles;
    }


}

