<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends BaseController
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.pages.signup');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(RegistrationRequest $request)
    {
        $collection = collect($request);
        logger($collection);
        DB::beginTransaction();
        try {
            $data =  User::create([
                'uuid'  => Str::uuid(),
                'firstname' => $collection['firstname'],
                'lastname' => $collection['lastname'],
                'mobile_number' => $collection['phone_number'],
                'email' => $collection['email'],
                'password' => Hash::make($collection['password']),
                'is_active' => 1,
            ]);
            if ($data) {
                $data->roles()->attach([2]);
                $profile = $data->profile()->updateorCreate([
                    'uuid'         => Str::uuid(),
                    'birthday'     => $collection['birthday'],
                    'state'     => $collection['state'],
                    'city'     => $collection['city'],
                ]);

                if (isset($collection['profile_picture'])) {
                    $file = $collection['profile_picture'];
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    if ($file->move(public_path('uploads'), $name)) {
                        $media = $data->media()->updateorCreate([
                            'uuid'  => Str::uuid(),
                            'file'  => $name,
                        ]);
                    }
                } else {
                    $media = $data->media()->updateorCreate([
                        'uuid'  => Str::uuid(),
                        'file'  => '',
                    ]);
                }

                $token = Str::random(64);

                UserVerify::create([
                    'user_id' => $data->id,
                    'token' => $token
                ]);

                $verifyMail = Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
                $verifyMail = true;
                if (isset($verifyMail) && !empty($verifyMail)) {
                    DB::commit();
                    return redirect("user/dashboard")->withSuccess('Great! You have Successfully loggedin');
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getCode() . '->' . $e->getLine() . '->' . $e->getMessage());
            return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('employee.dashboard.dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }
}
