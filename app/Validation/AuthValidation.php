<?php

namespace App\Validation;

use App\Models\UserModel;

class AuthValidation
{
    public function validateUser($str, string $field, array $data): bool
    {
        // dd($data);
        $model = new UserModel();
        $user = $model->where('email', $data['email'])
            ->first();
        if (!$user) {
            return false;
        }
        return password_verify($data['password'], $user['password']);
    }
}