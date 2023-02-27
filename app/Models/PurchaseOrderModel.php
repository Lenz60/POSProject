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
        'supplier_id', 'supplier_product_id', 'qty', 'discount',
        'dpp', 'ppn', 'total_price', 'purchased_at', 'name', 'price'
    ];
    protected $useTimestamps = true;

    public function get()
    {
        $model = new PurchaseOrderModel();
        $data = $model->findAll();
        return $data;
    }

    public function getAll()
    {
        $builder = $this->db->table('purchase_order');
        $builder->join('supplier', 'supplier.id = purchase_order.supplier_id');
        $builder->join('supplier_product', 'supplier_product.id = purchase_order.supplier_product_id');
        $builder->select('');
    }

    public function create($dataInserted)
    {
        $model = new PurchaseOrderModel();
        $modelProduct = new ProductModel();
        $productId = $dataInserted['product_id'];
        $builder = $modelProduct->table('product');
        $data = $builder->where('product_id', $productId)->first();
        if (!$data) {
            throw new Exception('Product not found');
        } else {
            return $data;
        }
    }
}
