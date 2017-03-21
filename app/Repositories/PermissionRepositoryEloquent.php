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

    /**
     * 返回用户的权限
     *
     * @param $user
     * @return Array
     */
    public function getPerm($user)
    {
        $roles = $this->role->find($user->id);
        $perms = $roles->perms()->get(['name'])->toArray();

        return $perms;
    }



}

