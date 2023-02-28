<?php

namespace App\Models;


use APP\Models\SupplierProductModel;
use CodeIgniter\Model;
use App\Models\ProductModel;
use Exception;

class PurchaseOrderModel extends Model
{

    protected $table = 'purchase_order';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'supplier_id', 'product_id', 'product_name', 'purchased_price', 'qty', 'discount',
        'dpp', 'ppn', 'total', 'purchased_at', 'name', 'price'
    ];
    // protected $useTimestamps = true;

    public function get()
    {
        $model = new PurchaseOrderModel();
        $data = $model->findAll();
        return $data;
    }


    public function getAll()
    {
        $modelPO = new PurchaseOrder();
        $builder = $modelPO->table('purchase_order');
        $builder->join('supplier', 'supplier.id = purchase_order.supplier_id');
        $builder->join('product', 'product.id = supplier.product_id');
        $builder->select('supplier.id,supplier.name,
                product.id,product.name,
                purchase_order.qty,purchase_order.purchased_price,
                purchase_order.discount,purchase_order.dpp,purchase_order.ppn,
                purchase_order.total,purchase_order.purchased_at');
        $data = $builder->findAll();
        return $data;
    }

    public function newProduct($dataInserted)
    {
        $modelProduct = new ProductModel();
        $productId = $dataInserted['product_id'];
        $builder = $modelProduct->table('product');
        $data = $builder->where('id', $productId)->first();
        if (!$data || $dataInserted['product_id'] == null) {
            $modelProduct->table('product');
            $id = $modelProduct->first();
            // $newId = $id['id'] + 1;
            // $dataInserted['product_id'] = $newId;
            $newProduct = [
                'supplier_id' => $dataInserted['supplier_id'],
                'name' => $dataInserted['product_name'],
                'qty' => $dataInserted['qty'],
                'price' => $dataInserted['total']
            ];
            $modelProduct->save($newProduct);
            $builder->orderBy('id', 'desc');
            $data2 = $builder->where('name', $dataInserted['product_name'])->first();
            return $data2['id'];
        }
    }


    public function updateQty($dataInserted)
    {
        $modelPO = new PurchaseOrderModel();
        $modelProduct = new ProductModel();
        $builder = $modelProduct->table('product');
        $data = [
            'supplier_id' => $dataInserted['supplier_id'],
            'name' => $dataInserted['name'],
            'qty' => $dataInserted['qty'],
            'price' => $dataInserted['total']
        ];
        $check = $builder->where('id', $dataInserted['id'])->first();
        if ($check) {
            $qtyNew = $data['qty'] + $check['qty'];
            $data['qty'] = $qtyNew;
            $builder->set($data);
            $builder->where('id', $dataInserted['id']);
            $builder->update();
            return $modelProduct->affectedRows();
        }
    }

    public function create($dataInserted)
    {
        $modelPO = new PurchaseOrderModel();
        $builder = $modelPO->table('purchase_order');
        $modelPO->save($dataInserted);
    }
}
