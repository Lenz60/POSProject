<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'address'];

    public function get()
    {
        $model = new CustomerModel();
        $data = $model->findAll();
        return $data;
    }

    public function create($dataInserted)
    {
        $model = new CustomerModel();
        $name = $dataInserted['name'];
        $builder = $model->table('customer');
        $data = $builder->where('name', $name)->first();
        if (!$data) {
            $model->save($dataInserted);
        } else {
            throw new PageNotFoundException('Supplier Already Exists');
        }
    }
}
