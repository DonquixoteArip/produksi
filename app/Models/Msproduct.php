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

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }
}
