<?php

namespace App\Repositories\Eloquent\User;

use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Hash;
use Str;

class UserRepository implements UserRepositoryInterface
{
    public function firstOrCreateFromSocial($data): User
    {
        return User::firstOrCreate(
            ['social_sub_id' => $data['sub']],
            [
                'name' => $data['name'],
                'password' => Hash::make(Str::random(16)),
                'email' => $data['email'],
                'provider_account' => $data['provider'],
            ]
        );
    }
}