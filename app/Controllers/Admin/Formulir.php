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

    public function store()
    {
        $data = $this->request->getVar();
        // dd($data);
        $field = [];

        foreach($data['judul'] as $key => $value) {
            $temp = [
                'judul' => $value,
                'tipe' => $data['tipe'][$key],
            ];

            if ($data['tipe'][$key] == 'radio' || $data['tipe'][$key] == 'checkbox') {
                $temp['choice'] = $data['choice'][$key];
            }

            $field[] = $temp;
        }
        
        $data = [
            'nama' => $data['nama_formulir'],
            'field' => json_encode($field),
        ];

        $this->formulirModel->insert($data);

        session()->setFlashdata('success', 'Formulir berhasil ditambahkan.');

        return redirect()->route('formulir.index');
    }
}
