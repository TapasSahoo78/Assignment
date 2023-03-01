<?php

namespace App\Contracts;

interface AdminContract
{
    public function getAllAdminUser();
    public function storeAdmin($request);
    public function editAdmin($id);
    public function updateAdmin($request, $id);
    public function deleteAdmin($id);
}
