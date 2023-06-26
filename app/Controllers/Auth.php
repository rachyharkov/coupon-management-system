<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController
{
    public function index()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect('dashboard');
        }
        return view('login');
    }

    public function login()
    {
        $dataLogin = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];

        $errors = [
            'email' => [
                'validateUser' => 'Email don\'t match'
            ],
            'password' => [
                'validateUser' => 'Username or Password don\'t match'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return view('login', [
                'validation' => $this->validator
            ]);
        } else {
            $model = new UserModel();
            $user = $model->where('email', $dataLogin['email'])
                ->first();
            $this->setUserSession($user);
            return redirect()->to('dashboard');
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'id'        => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'isLoggedIn' => true,
        ];

        $this->session->set($data);
        return true;
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
