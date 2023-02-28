<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['supplier_id', 'name', 'qty', 'price'];


    public function get()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return $data;
    }

    public function getPriceItem($suppProId)
    {
        // dd($suppProId);
        $builder = $this->table('product');
        $priceItem = $builder->where('id', $suppProId)->first();
        if ($priceItem != null) {
            return $priceItem['price'];
        } else {
            throw new PageNotFoundException('Product with id Suplier not found.');
        }
    }

    // public function insertnewProduct($dataInserted)
    // {
    //     $model = new ProductModel();
    //     $builder = $model->table('product');
    //     $data = $model->save($dataInserted);
    //     dd($data);
    // }
}
