<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    protected $dates = [
        'birthday'
    ];

    protected $appends = array('profilePicture');

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . (!is_null($this->lastname) ?  ' ' . $this->lastname : '');
    }
    public function profilePicture($type = 'original')
    {
        $profilePicture = $this->media()->where('is_profile_picture', 1)->value('file');
        if (!is_null($profilePicture)) {
            $fileDisk = config('constants.SITE_FILE_STORAGE_DISK');
            if ($fileDisk == 'public') {
                if (file_exists(public_path('storage/images/' . $type . '/' . $profilePicture))) {
                    return asset('storage/images/' . $type . '/' . $profilePicture);
                }
            }
        }
        return asset('assets/dist/img/profile_placeholder.jpg');
    }
    public function media()
    {
        return $this->hasMany('App\Models\Media');
    }
}
