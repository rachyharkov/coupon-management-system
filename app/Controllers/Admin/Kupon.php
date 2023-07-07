<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormulirModel;
use App\Models\KuponCodesModel;
use App\Models\KuponModel;
use App\Models\KuponProductsModel;

class Kupon extends BaseController
{
    protected $kuponModel;
    protected $formulirModel;
    protected $kuponCodesModel;
    protected $KuponProductsModel;

    public function __construct()
    {
        $this->kuponModel = new KuponModel();
        $this->formulirModel = new FormulirModel();
        $this->kuponCodesModel = new KuponCodesModel();
        $this->KuponProductsModel = new KuponProductsModel();

    }

    public function index()
    {
        $data = [
            'title' => 'Kupon',
            'kupons' => $this->kuponModel->findAll()
        ];
        return view('admin/kupon/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kupon',
            'validation' => \Config\Services::validation(),
            'formulirs' => $this->formulirModel->findAll(),
        ];
        return view('admin/kupon/create', $data);
    }

    public function store() 
    {
        $data = $this->request->getVar();

        if(isset($data['condition_custom'])) {
            $data['condition_custom'] = json_encode($data['condition_custom']);
        }
        $this->kuponModel->insert($data);


        for($i = 0; $i < count($data['product_name']); $i++) {
            $product = [
                'product_name' => $data['product_name'][$i],
                'price_original' => $data['coupon_value_in_price_original'][$i] ?? null,
                'discount_percentage' => $data['coupon_value_in_discount_percentage'][$i] ?? null,
                'discount_fixed' => $data['coupon_value_in_discount_fixed'][$i] ?? null,
                'value_fixed' => $data['coupon_value_in_fixed'][$i] ?? null,
                'value_buy' => $data['coupon_value_in_buy'][$i] ?? null,
                'value_free' => $data['coupon_value_in_free'][$i] ?? null,
                'kupon_id' => $this->kuponModel->getInsertID(),
            ];
            $this->KuponProductsModel->insert($product);
        }

        $codes = generate_coupon_codes($data['code_total'], $data['code_length']);
        foreach($codes as $code) {
            $coupon = [
                'code' => $code,
                'kupon_id' => $this->kuponModel->getInsertID(),
            ];
            $this->kuponCodesModel->insert($coupon);
        }

        session()->setFlashdata('success', 'Formulir berhasil ditambahkan.');
        return redirect()->route('kupon.index');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kupon',
            'validation' => \Config\Services::validation(),
            'formulirs' => $this->formulirModel->findAll(),
            'kupon' => $this->kuponModel->find($id),
            'kupon_products' => $this->KuponProductsModel->where('kupon_id', $id)->findAll(),
        ];
        return view('admin/kupon/edit', $data);
    }
}
