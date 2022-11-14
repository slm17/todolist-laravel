<?php

namespace App\services\impl;

use App\services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "slm" => "slm17"
    ];

    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }
        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}
