<?php

namespace App\Models;

use CodeIgniter\Model;

class Msproduct extends Model
{
    protected $table = "productionorder as p";

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            null,
            "serialnumber",
            null,
        ];
    }

    public function getAll($param, $text)
    {
        return $this->builder
            ->select('p.id, p.orderdate, p.batchnumber, ps.serialnumber')
            ->join('productionordersn as ps', 'p.id = ps.headerid');
    }

    public function getOne($id)
    {
        return $this->builder
            ->select('p.id, p.ordernumber, p.productid, p.orderdate, p.profcenter, p.batchnumber, p.location')
            ->where('p.id', $id)
            ->get()->getRowArray();
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }
}
