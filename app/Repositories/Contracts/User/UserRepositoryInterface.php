<?php

namespace App\Repositories\Contracts\User;
interface UserRepositoryInterface
{
    public function firstOrCreateFromSocial(array $data);
}