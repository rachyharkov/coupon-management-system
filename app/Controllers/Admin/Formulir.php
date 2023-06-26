<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormulirModel;

class Formulir extends BaseController
{
    protected $formulirModel;

    public function __construct()
    {
        $this->formulirModel = new FormulirModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Formulir',
            'formulirs' => $this->formulirModel->findAll(),
        ];
        return view('admin/formulir/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Formulir',
        ];
        return view('admin/formulir/create', $data);
    }
}
