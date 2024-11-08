<?php

namespace App\Helpers;

class PasswordHelper
{
    /**
     * Generate a random password
     * 
     * @param int $length
     * @return string
     */
    public static function generateRandomPassword($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
        }
        
        return $randomPassword;
    }

    /**
     * Hash a password
     * 
     * @param string $password
     * @return string
     */
    public static function hashPassword($password)
    {
        return bcrypt($password);
    }

    /**
     * Validate password complexity
     * 
     * @param string $password
     * @return bool
     */
    public static function validatePasswordComplexity($password)
    {
        // At least 8 characters, one uppercase, one lowercase, one number, one special character
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }
}
