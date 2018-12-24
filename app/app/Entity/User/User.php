<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_USER = 'user';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'verify_token', 'status', 'role',
    ];

    protected $hidden = [
        'pasvord', 'remember_token'
    ];

    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'first_name' => $name,
            'email' => $email, 
            'password' => bcrypt($password), 
            'verify_token' => Str::uuid(),
            'status' => self::STATUS_WAIT,
            'role' => self::ROLE_USER,
        ]);
    }

    public function verify()
    {
        if($this->isActive()) {
            throw new \DomainException('Пользователь уже верифицирован!');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_token' => null
        ]);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name; 
    }
    public function isWait()
    {
        return $this->status == self::STATUS_WAIT;
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }
}
