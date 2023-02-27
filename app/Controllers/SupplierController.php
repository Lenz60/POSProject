<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use CodeIgniter\API\ResponseTrait;
use App\View\Pages\Supplier;

class SupplierController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new SupplierModel();
        $data = $model->get();
        // $data = $model->getQuery();
        return view('/pages/Supplier', ['data' => $data]);
    }

    public function insert()
    {
        $model = new SupplierModel();
        $name = $this->request->getVar('name');
        $vendor = $this->request->getVar('vendor');
        $data = [
            'name' => $name,
            'vendor' => $vendor
        ];
        $model->create($data);
        $dataview = $model->get();
        return view('/pages/supplier', ['data' => $dataview]);
    }
}
