<?php

namespace App\Services;

use App\Contracts\ProfileContract;
use App\Contracts\RolePermissionContract;

/**
 * Class ProfileService
 * @package App\Services
 */
class ProfileService
{
    /**
     * Class RolePermissionService
     * @var ProfileContract
     */
    protected $ProfileRepository;

    public function __construct(ProfileContract $ProfileRepository)
    {
        $this->ProfileRepository = $ProfileRepository;
    }

    /**
     * To edit a record
     *
     * @param $id
     * @return $value
     */
    public function showUserProfile()
    {
        return $this->ProfileRepository->showProfile();
    }
    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updatePhoto($request)
    {
        return $this->ProfileRepository->updatePhoto($request);
    }
    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updateUser($request)
    {
        return $this->ProfileRepository->updateUser($request);
    }
    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updateProfile($request)
    {
        return $this->ProfileRepository->updateProfile($request);
    }

    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updatePaaword($request)
    {
        return $this->ProfileRepository->updatePaaword($request);
    }

    /**
     * To update a record
     *
     * @param $request, $id
     */
    public function updateAddress($request)
    {
        return $this->ProfileRepository->updateAddress($request);
    }
}
