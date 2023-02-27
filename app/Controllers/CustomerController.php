<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{

    public function __construct()
    {
        $this->costumerModel = new CustomerModel();
    }
    public function index()
    {
        $model = new CustomerModel();
        $data = $model->get();
        return view('pages/Customer', ['data' => $data]);
    }
    public function insert()
    {
        $model = new CustomerModel();
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $address = $this->request->getVar('address');
        $data = [
            'name' => $name,
            'email' => $email,
            'address' => $address
        ];
        $model->create($data);
        $dataCustomer = $model->get();
        return view('pages/Customer', ['data' => $dataCustomer]);
    }
}
