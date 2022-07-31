<?php

namespace App\Models;

use CodeIgniter\Model;

class Msproduct extends Model
{
    protected $table = "msproduct as pro";

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            "pro.partnumber",
            "pro.productname",
        ];
    }

    public function getAll($param, $text)
    {
        return $this->builder;
    }

    public function getSel2($searchTerm)
    {
        return $this->builder
            ->select('pro.productid, pro.productname')
            ->where("pro.productname like '%" . $searchTerm . "%'")
            ->orderBy("pro.productname", 'asc')
            ->get()->getResultArray();
    }

    public function getOne($id)
    {
        return $this->builder
            ->where('pro.productid', $id)
            ->get()->getRowArray();
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }

    public function edit($data, $id)
    {
        return $this->builder->update($data, ['pro.productid' => $id]);
    }

    public function hapus($id)
    {
        return $this->builder->delete(['pro.productid' => $id]);
    }
}
