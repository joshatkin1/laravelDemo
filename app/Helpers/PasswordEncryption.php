<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class PasswordEncryption
{
    private $passwordSalt;

    public function __construct()
    {
        $this->passwordSalt = env('PASSWORD_SALT');
    }

    /**
     * This hashes the password
     *
     * @param string $password
     * @return string
     */
    public function hash(string $password): string
    {
        return Hash::make($password . $this->passwordSalt, [
            'memory' => 65536,
            'threads' => 4,
            'time' => 3,
            'salt' => '23hd4743'
        ]);
    }

    /**
     * This Checks if the submitted password is the Hashed password
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function check(string $password , string $hash): bool
    {
        return Hash::check($password . $this->passwordSalt, $hash, [
            'memory' => 65536,
            'threads' => 4,
            'time' => 3,
            'salt' => '23hd4743'
        ]);
    }

    /**
     * Check if the hashed password needs re-hashed
     *
     * @param string $hash
     * @return bool
     */
    public function needsRehash(string $hash): bool
    {
        return Hash::needsRehash($hash, [
            'memory' => 65536,
            'threads' => 4,
            'time' => 3,
            'salt' => '23hd4743'
        ]);
    }
}