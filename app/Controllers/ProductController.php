<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use App\View\Pages\Supplier;

class ProductController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ProductModel();
        $data = $model->get();
        return view('/pages/Product', ['data' => $data]);
    }
}
