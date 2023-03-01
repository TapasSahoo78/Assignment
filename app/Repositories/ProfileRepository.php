<?php

namespace App\Repositories;

use App\Contracts\ProfileContract;
use App\Models\Media;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileRepository extends BaseRepository implements ProfileContract
{
    /**
     * @package \App\Repositories
     * Class RolePermissionRepository.
     */

    protected $userModel;
    protected $profileModel;
    protected $mediaModel;

    public function __construct(User $userModel, Profile $profileModel, Media $mediaModel)
    {
        $this->userModel = $userModel;
        $this->profileModel = $profileModel;
        $this->mediaModel = $mediaModel;
    }

    /**
     * To edit a record
     *
     * @param array $id
     */
    public function showProfile()
    {
        return $this->userModel::where('id', Auth::user()->id)->with('profile', 'media')->first();
    }
    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updatePhoto($attributes)
    {
        $collection = collect($attributes);

        $media = $this->mediaModel::where('user_id', $collection['user_id'])->first();

        if (isset($collection['profile_picture'])) {
            if (File::exists(public_path('uploads/' . $media->file))) {
                File::delete(public_path('uploads/' . $media->file));
            }
            $file = $collection['profile_picture'];
            $name = time() . rand(1, 100) . '.' . $file->extension();
            if ($file->move(public_path('uploads'), $name)) {
                $media->file = $name;
            }
        }
        $result = $media->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updateUser($attributes)
    {
        $collection = collect($attributes);

        $usrs = $this->userModel::where('id', $collection['user_id'])->first();

        $usrs->firstname = $collection['firstname'] ?? $usrs->firstname;
        $usrs->lastname = $collection['lastname'] ?? $usrs->lastname;
        $usrs->alternate_mobile_number = $collection['alternate_phone_number'] ?? $usrs->alternate_mobile_number;

        $result = $usrs->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updatePaaword($attributes)
    {
        $collection = collect($attributes);

        $usrs = $this->userModel::where('id', $collection['user_id'])->first();

        $usrs->password = Hash::make($collection['new_password']);

        $result = $usrs->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updateProfile($attributes)
    {
        $collection = collect($attributes);
        // dd($collection);

        $profile = $this->profileModel::where('user_id', $collection['user_id'])->first();

        $profile->gender = $collection['gender'] ?? $profile->gender;
        $profile->birthday = $collection['birthday'] ?? $profile->birthday;

        $result = $profile->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updateAddress($attributes)
    {
        $collection = collect($attributes);

        $profile = $this->profileModel::where('user_id', $collection['user_id'])->first();

        $profile->address = $collection['address'] ?? $profile->address;
        $profile->state = $collection['state'] ?? $profile->state;
        $profile->city = $collection['city'] ?? $profile->city;
        $profile->pincode = $collection['pin_code'] ?? $profile->pincode;

        $result = $profile->save();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
