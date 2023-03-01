<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Role\RolePermissionRequest;
use App\Services\RolePermissionService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends BaseController
{
    protected $RolePermissionService;

    public function __construct(RolePermissionService $RolePermissionService)
    {
        $this->RolePermissionService = $RolePermissionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('role.list')) {
            $this->setPageTitle('Roles', '');
            $roleWithPermission = $this->RolePermissionService->getRoleWithPermssion();
            return view('admin.roles.index', compact('roleWithPermission'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('role.create')) {
            $this->setPageTitle('Create Role', '');
            $permissions = $this->RolePermissionService->getAllPermissions();
            return view('admin.roles.create', compact('permissions'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        DB::beginTransaction();
        try {
            $store = $this->RolePermissionService->storeRoleWithPermssion($request);

            if (isset($store) && !empty($store)) {
                DB::commit();
                return redirect()->route('roles.index')->with('success', config('custom.MSG_RECORD_INSERT_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_INSERT_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (auth()->user()->can('role.edit')) {
            $edit_id = Crypt::decrypt($id);
            $permissions = $this->RolePermissionService->getAllPermissions();
            $editRole = $this->RolePermissionService->editRoleWithPermssion($edit_id);
            return view('admin.roles.create', compact('permissions', 'editRole'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|max:100|unique:roles,name,' . $id
            ], [
                'name.requried' => 'Please give a role name'
            ]);
            $update = $this->RolePermissionService->updateRoleWithPermssion($request, $id);
            if (isset($update) && !empty($update)) {
                DB::commit();
                return redirect()->route('roles.index')->with('success', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('role.delete')) {
            try {
                $delete = $this->RolePermissionService->deleteRoleWithPermssion($id);
                if (isset($delete) && !empty($delete)) {
                    return redirect()->route('roles.index')->with('success', config('custom.MSG_RECORD_DELETE_SUCCESS'));
                } else {
                    return $this->responseRedirectBack(config('custom.MSG_RECORD_DELETE_FAILED'), 'error', true, true);
                }
            } catch (Exception $e) {
                logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
            }
        }
    }
}
