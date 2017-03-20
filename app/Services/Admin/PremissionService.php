<?php
namespace App\Services\Admin;
use App\Repositories\PremissionRepositoryEloquent;
use App\Services\Admin\BaseService;
use Exception,DB;

class PremissionService extends BaseService
{
	private $premission;

	public function __construct(PremissionRepositoryEloquent $premission)
	{
		$this->premission = $premission;
	}

	public function model()
    {
        return $this->model();
    }

	public function getTopPremission()
    {
        return $this->premission->getTopPremission();
    }

    public function getAllPremission()
    {
        return $this->premission->getAllPremission();
    }

    public function ajaxList()
    {
        return $this->premission->ajaxList();
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