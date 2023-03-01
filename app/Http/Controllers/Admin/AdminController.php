<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Services\AdminService;
use App\Services\RolePermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Exception;

class AdminController extends BaseController
{
    protected $AdminService;
    protected $RolePermissionService;

    public function __construct(AdminService $AdminService, RolePermissionService $RolePermissionService)
    {
        $this->AdminService = $AdminService;
        $this->RolePermissionService = $RolePermissionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('user.list')) {
            $adminUser = $this->AdminService->getAllAdminUser();
            return view('admin.user.index', compact('adminUser'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('user.create')) {
            $roles = $this->RolePermissionService->getAdminRole();
            return view('admin.user.create', compact('roles'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $store = $this->AdminService->storeAdminUser($request);

            if (isset($store) && !empty($store)) {
                DB::commit();
                return redirect()->route('users.index')->with('success', config('custom.MSG_RECORD_INSERT_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_INSERT_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('user.delete')) {
            try {
                $delete = $this->AdminService->deleteAdminUser($id);
                if (isset($delete) && !empty($delete)) {
                    return redirect()->route('users.index')->with('success', config('custom.MSG_RECORD_DELETE_SUCCESS'));
                } else {
                    return $this->responseRedirectBack(config('custom.MSG_RECORD_DELETE_FAILED'), 'error', true, true);
                }
            } catch (Exception $e) {
                logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
            }
        }
    }
}
