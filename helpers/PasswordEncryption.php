<?php

namespace helpers;

use Illuminate\Support\Facades\Hash;

class PasswordEncryption
{
    private $passwordSalt;

    public function __construct()
    {
        $this->passwordSalt = env('PASSWORD_SALT');
    }

    public function hash(string $password): string
    {
        return Hash::make($password . $this->passwordSalt, [
            'rounds' => 12,
        ]);
    }
}