<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kupon extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kupon',
        ];
        return view('admin/kupon/index', $data);
    }
}
