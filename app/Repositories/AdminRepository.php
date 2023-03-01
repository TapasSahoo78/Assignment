<?php

namespace App\Repositories;

use App\Contracts\AdminContract;
use App\Models\Media;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminRepository extends BaseRepository implements AdminContract
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
     * Return all model rows
     * @return array
     */
    public function getAllAdminUser()
    {
        $adminDetails = $this->userModel::whereHas(
            'roles',
            function ($q) {
                $q->where('slug', '!=', 'user');
            }
        )
            ->whereHas('roles', function ($q) {
                $q->Where('slug', '!=', 'super-admin');
            })->with('profile', 'media')->get();

        return $adminDetails;
    }

    /**
     * To Create a record
     *
     * @param array $attributes
     */
    public function storeAdmin($attributes)
    {
        $collection = collect($attributes);

        $useRole = $collection['userType'];

        $data =  $this->userModel->create([
            'uuid'  => Str::uuid(),
            'firstname' => $collection['firstname'],
            'lastname' => $collection['lastname'],
            'mobile_number' => $collection['phone_number'],
            'alternate_mobile_number' => $collection['alternate_phone_number'] ?? '',
            'email' => $collection['email'],
            'password' => Hash::make($collection['password']),
            'is_active' => 1,
        ]);

        if ($data) {
            $data->roles()->attach($useRole);
            $profile = $data->profile()->updateorCreate([
                'uuid'         => Str::uuid(),
                'birthday'     => $collection['birthday'],
                'state'     => $collection['state'],
                'city'     => $collection['city'],
                'gender'     => $collection['gender'],
                'address'     => trim($collection['address']),
                'pincode'     => $collection['pin_code'],
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

            if ($media) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * To edit a record
     *
     * @param array $id
     */
    public function editAdmin($id)
    {
        return $this->userModel::with('profile', 'media')->find($id);
    }
    /**
     * To update a record
     *
     * @param array $attributes,$id
     */
    public function updateAdmin($attributes, $id)
    {
    }
    /**
     * To delete a record
     *
     * @param array $id
     */
    public function deleteAdmin($id)
    {
        if (isset($id) && !empty($id)) {
            $media = $this->mediaModel->where('user_id', $id)->first();
            if (isset($media) && !empty($media)) {
                if (File::exists(public_path('uploads/' . $media->file))) {
                    File::delete(public_path('uploads/' . $media->file));
                }
                $this->mediaModel->where('user_id', $id)->delete();
            }
            $profile = $this->profileModel->where('user_id', $id)->first();
            if (isset($profile) && !empty($profile)) {
                $this->profileModel->where('user_id', $id)->delete();
            }
            DB::table('users_roles')
                ->where('user_id', $id)
                ->delete();
            $adminUser = $this->userModel->where('id', $id)->delete();

            if (isset($adminUser) && !empty($adminUser)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
