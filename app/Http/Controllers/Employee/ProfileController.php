<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends BaseController
{
    protected $ProfileService;

    public function __construct(ProfileService $ProfileService)
    {
        $this->ProfileService = $ProfileService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setPageTitle('Roles', '');
        $showProfile = $this->ProfileService->showUserProfile();

        return view('employee.profile.show', compact('showProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePhoto(Request $request)
    {
        try {
            $update = $this->ProfileService->updatePhoto($request);
            if (isset($update) && !empty($update)) {
                return redirect()->back()->with('message', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $update = $this->ProfileService->updateUser($request);
            if (isset($update) && !empty($update)) {
                return redirect()->back()->with('message', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $update = $this->ProfileService->updateProfile($request);
            if (isset($update) && !empty($update)) {
                return redirect()->back()->with('message', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }

    public function updatePaaword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $update = $this->ProfileService->updatePaaword($request);
        if (isset($update) && !empty($update)) {
            return redirect()->back()->with('message', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
        } else {
            return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
        }
    }

    public function updateAddress(Request $request)
    {
        try {
            $update = $this->ProfileService->updateAddress($request);
            if (isset($update) && !empty($update)) {
                return redirect()->back()->with('message', config('custom.MSG_RECORD_UPDATE_SUCCESS'));
            } else {
                return $this->responseRedirectBack(config('custom.MSG_RECORD_UPDATE_FAILED'), 'error', true, true);
            }
        } catch (Exception $e) {
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
        }
    }
}
