<?php

namespace App\Contracts;

interface ProfileContract
{
    public function showProfile();
    public function updatePhoto($request);
    public function updateUser($request);
    public function updateProfile($request);
    public function updatePaaword($request);
    public function updateAddress($request);
}
