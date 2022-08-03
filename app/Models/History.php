<?php

namespace App\Models;

use CodeIgniter\Model;

class History extends Model
{
    protected $table = 'productionorder as p';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            'productname',
            'partnumber',
            'ordernumber',
            null,
            null,
            null,
            null,
            'batchnumber',
            'serialnumber',
        ];
    }

    public function getAll($param, $text)
    {
        return $this->builder
            ->select('p.id, p.productid, p.ordernumber as ordernum, p.orderdate, p.location, p.profcenter, 
                        p.productiondate as mm, p.batchnumber as batch, ps.headerid, ps.serialnumber as serialnum, 
                        pr.productid, pr.productname as prodname, pr.partnumber as partnum')
            ->join('productionordersn as ps', 'p.id = ps.headerid')
            ->join('msproduct as pr', 'p.productid = pr.productid');
    }
}
