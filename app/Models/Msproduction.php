<?php

namespace App\Models;

use CodeIgniter\Model;

class Msproduction extends Model
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

    public function count($header)
    {
        return $this->builder
            ->join('productionordersn as ps', 'p.id = ps.headerid')
            ->join('productionresult as r', 'ps.id = r.snid', 'left')
            ->where('ps.headerid', $header)
            ->where('r.snid IS NULL')
            ->countAllResults();
    }

    public function getData($header)
    {
        return $this->builder
            ->select('p.id, p.orderdate, p.ordernumber, p.batchnumber, ps.serialnumber, r.snid')
            ->join('productionordersn as ps', 'p.id = ps.headerid')
            ->join('productionresult as r', 'ps.id = r.snid', 'left')
            ->where('r.snid IS NULL')
            ->where('ps.headerid', $header)
            ->get()->getResultArray();
    }

    public function getAll($param, $text)
    {
        return $this->builder
            ->select('p.id, p.orderdate, p.batchnumber, ps.serialnumber')
            ->join('productionordersn as ps', 'p.id = ps.headerid');
    }

    public function getCompare($val, $header)
    {
        return $this->builder
            ->select('p.id, p.ordernumber, ps.serialnumber, ps.id as ids')
            ->join('productionordersn as ps', 'p.id = ps.headerid')
            ->where('ps.serialnumber', $val)
            ->where('ps.headerid', $header)
            ->get()->getRowArray();
    }

    public function countComp($val)
    {
        return $this->builder
            ->join('productionordersn as ps', 'p.id = ps.headerid')
            ->where('ps.serialnumber', $val)
            ->countAllResults();
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
