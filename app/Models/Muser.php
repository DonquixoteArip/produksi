<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $table = 'msuser as u';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function tambah($data)
    {
        return $this->builder->insert($data);
    }

    public function cek($uname)
    {
        return $this->builder
            ->where("u.username", $uname)
            ->get()->getRowArray();
    }
}
