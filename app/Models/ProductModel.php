<?php

namespace APP\Models;

use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;
use CodeIgniter\Config\Database;

class ProductModel extends Model
{
    use ResponseTrait;
    protected $table = 'product';
    protected $primaryKey = 'id';


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
            throw new PageNotFoundException;
        }
    }
}
