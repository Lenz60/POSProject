<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PurchaseOrderModel;
use App\Models\SupplierModel;

class PurchaseOrderController extends BaseController
{
    function __construct()
    {
        $this->PurchaseOrder = new PurchaseOrderModel();
    }
    public function index()
    {
        // $model = new PurchaseOrderModel();
        // $dataProduct = $model->get();
        // dd($dataProduct);
        // return view('/pages/Purchase', ['data' => $dataProduct]);
        return view('/pages/Purchase');
    }

    public function insert()
    {
        $product = new ProductModel();
        $purchaseOrder = new PurchaseOrderModel();
        $supplierId = $this->request->getVar('suppid');
        $productId = $this->request->getVar('prodid');
        $newProductName = $this->request->getVar('newprodname');
        $purchasedPrice = $this->request->getVar('purprice');
        $qty = $this->request->getVar('qty');
        $discount = $this->request->getVar('discount');
        if ($productId == null || $productId == 0) {
            $price1 = $purchasedPrice * $qty;
            $discountValue = $discount / 100;
            $discountedCalc = $price1 * $discountValue;
            $discountedPrice = $price1 - $discountedCalc;
            $dppValue = 100 / 111;
            $ppnValue = 11 / 100;
            $dppPrice = $dppValue * $discountedPrice;
            $ppnPrice = $ppnValue * $dppPrice;


            $totalPrice = $discountedPrice - $ppnPrice;

            $data = [
                'supplier_id' => $supplierId,
                'product_id' => $productId,
                'product_name' => $newProductName,
                'purchased_price' => $purchasedPrice,
                'qty' => $qty,
                'discount' => $discount,
                'dpp' => $dppPrice,
                'ppn' => $ppnPrice,
                'total' => $totalPrice,
                'purchased_at' => date("Y-m-d H:i:s"),
            ];
            $purchaseOrder->newProduct($data);

            $data2 = [
                'supplier_id' => $supplierId,
                'product_id' => $productId,
                'purchased_price' => $purchasedPrice,
                'qty' => $qty,
                'discount' => $discount,
                'dpp' => $dppPrice,
                'ppn' => $ppnPrice,
                'total' => $totalPrice,
                'purchased_at' => date("Y-m-d H:i:s"),
            ];

            // number_format((float)$dppPrice, 2, ',', ''),
            $purchaseOrder->create($data2);
        } else {
            $priceItem = $product->getPriceItem($productId);

            $price1 = $priceItem * $qty;
            $discountValue = $discount / 100;
            $discountedCalc = $price1 * $discountValue;
            $discountedPrice = $price1 - $discountedCalc;
            $dppValue = 100 / 111;
            $ppnValue = 11 / 100;
            $dppPrice = $dppValue * $discountedPrice;
            $ppnPrice = $ppnValue * $dppPrice;

            $totalPrice = $discountedPrice - $ppnPrice;


            $data = [
                'supplier_id' => $supplierId,
                'product_id' => $productId,
                'purchased_price' => $purchasedPrice,
                'qty' => $qty,
                'discount' => $discount,
                'dpp' => $dppPrice,
                'ppn' => $ppnPrice,
                'total' => $totalPrice,
                'purchased_at' => date("Y-m-d H:i:s"),
            ];

            // number_format((float)$dppPrice, 2, ',', ''),

            // dd($data);
            $purchaseOrder->updateQty($data);
        }
        // dd($totalPrice);


    }
}
