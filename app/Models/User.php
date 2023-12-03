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

    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_SUPERADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar'
    ];

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
        'password' => 'hashed',
    ];

    public static function getRoles()
    {
        return [
            self::ROLE_USER => 'User',
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_SUPERADMIN => 'Super Admin',
        ];
    }

    public function isUser()
    {
        return $this->role == self::ROLE_USER;
    }

    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isSuperAdmin()
    {
        return $this->role == self::ROLE_SUPERADMIN;
    }

    public function getRoleName()
    {
        if ($this->isAdmin()) {
            return 'Admin';
        } else if ($this->isSuperAdmin()) {
            return 'Super Admin';
        } else {
            return 'User';
        }
    }

    public function getImage()
    {
        if (!$this->avatar) {
            return asset('no-user-image.jpg');
        }

        return asset("storage/$this->avatar");
    }

    public static function getUsersByFilter($data)
    {
        $userQuery = User::query();

        if (isset($data['name'])) {
            $userQuery->where('name', 'like', "%{$data['name']}%");
        }
        if (isset($data['email'])) {
            $userQuery->where('email', 'like', "%{$data['email']}%");
        }
        if (isset($data['role']) && $data['role'] != 'all') {
            $userQuery->where('role', $data['role']);
        }

        return $userQuery->where('id', '!=', auth()->user()->id)->latest()->paginate(10);
    }
}
