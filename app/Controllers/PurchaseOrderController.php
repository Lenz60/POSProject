<?php

namespace App\Controllers;

use APP\Models\ProductModel;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;

class PurchaseOrderController extends BaseController
{
    function __construct()
    {
        $this->PurchaseOrder = new PurchaseOrderModel();
        $this->Product = new ProductModel();
        $this->Supplier = new SupplierModel();
    }
    public function index()
    {
        $model = new PurchaseOrderModel();
        $dataProduct = $model->get();
        // dd($dataProduct);
        return view('/pages/Purchase', ['data' => $dataProduct]);
    }

    public function insert()
    {
        $model = new ProductModel();
        $supplierId = $this->request->getVar('suppid');
        $productId = $this->request->getVar('prodid');
        $qty = $this->request->getVar('qty');
        $discount = $this->request->getVar('discount');

        $priceItem = $model->getPriceItem($productId);

        $price1 = $priceItem * $qty;
        $discountValue = $discount / 100;
        $discountedCalc = $price1 * $discountValue;
        $discountedPrice = $price1 - $discountedCalc;
        $dppValue = 100 / 111;
        $ppnValue = 11 / 100;
        $dppPrice = $dppValue * $discountedPrice;
        $ppnPrice = $ppnValue * $dppPrice;

        $totalPrice = $discountedPrice - $ppnPrice;


        // dd($totalPrice);

        $data = [
            'supplier_id' => $supplierId,
            'product_id' => $productId,
            'qty' => $qty,
            'discount' => $discount,
            'dpp' => $dppPrice,
            'ppn' => $ppnPrice,
            'total_price' => $totalPrice
        ];

        dd($data);
        // $model->create($data);
    }
}
