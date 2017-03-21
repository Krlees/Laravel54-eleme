<?php
namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepositoryEloquent extends BaseRepository
{
    private $role;
    private $perm;

    public function __construct(Role $role, Permission $perm)
    {
        $this->role = $role;
        $this->perm = $perm;
    }

    public function model()
    {
        // TODO: Implement model() method.
        return Permission::class;
    }

    public function roleModel()
    {
        // TODO: Implement model() method.
        return Role::class;
    }

    public function ajaxPermList($offset, $limit, $sort=false, $order, $where = [])
    {
        $sort = $sort ?: $this->perm->getKeyName();

        $rows = $this->perm->where($where)->orderBy($sort,$order)->offset($offset)->limit($limit)->get()->toArray();
        $total = $this->perm->count();

        return compact('rows', 'total');
    }

    public function getPermSelects($id)
    {
        return $this->perm->where(['pid'=>$id])->get(['name','pid','id','display_name']);
    }

    /**
     * 返回用户的权限
     *
     * @param $user
     * @return Array
     */
    public function getPerm($user)
    {
        $roles = $this->role->find($user->id);
        if( !$roles){
            return [];
        }
        $perms = $roles->perms()->get(['name'])->toArray();

        return $perms;
    }


}

