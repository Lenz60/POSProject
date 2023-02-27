<?php

namespace APP\Models;

use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;
use CodeIgniter\Config\Database;

class SupplierModel extends Model
{
    use ResponseTrait;
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'vendor'];

    public function create($dataInserted)
    {
        $model = new SupplierModel();
        $name = $dataInserted['name'];
        $builder = $model->table('supplier');
        $data = $builder->where('name', $name)->first();
        if (!$data) {
            $model->save($dataInserted);
        } else {
            throw new PageNotFoundException('Supplier Already Exists');
        }
    }

    public function get()
    {
        $model = new SupplierModel();
        $data = $model->findAll();
        return $data;
    }

    // public function getQuery()
    // {
    //     $query = $this->db->query("SELECT * FROM supplier");
    //     $data['supplier'] = $query->getResult();
    //     return $data;
    // }
}
