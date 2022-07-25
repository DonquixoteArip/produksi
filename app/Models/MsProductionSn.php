<?php

namespace App\Models;

use CodeIgniter\Model;

class MsProductionSn extends Model
{
    protected $table = 'productionordersn as sn';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }
}
