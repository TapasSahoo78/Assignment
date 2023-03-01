<?php

namespace App\Services;

use App\Contracts\AdminContract;
use App\Contracts\RolePermissionContract;

/**
 * Class AdminService
 * @package App\Services
 */
class AdminService
{
    /**
     * Class AdminService
     * @var AdminContract
     */
    protected $AdminRepository;

    public function __construct(AdminContract $AdminRepository)
    {
        $this->AdminRepository = $AdminRepository;
    }

    /**
     * Return all model rows
     * @return array
     */
    public function getAllAdminUser()
    {
        return $this->AdminRepository->getAllAdminUser();
    }


    /**
     * To Create a record
     *
     * @param array $attributes
     */
    public function storeAdminUser($request)
    {
        return $this->AdminRepository->storeAdmin($request);
    }
    /**
     * To edit a record
     *
     * @param $id
     * @return $value
     */
    public function editAdminUser($id)
    {
        return $this->AdminRepository->editAdmin($id);
    }
    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updateAdminUser($request, $id)
    {
        return $this->AdminRepository->updateAdmin($request, $id);
    }
    /**
     * To Delete a record
     *
     * @param $id
     */
    public function deleteAdminUser($id)
    {
        return $this->AdminRepository->deleteAdmin($id);
    }
}
