<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msproduct;
use App\Models\MsProductionSn;
use DateTime;
use Exception;
use Picqer\Barcode\BarcodeGeneratorHTML;

class Product extends BaseController
{
    public function __construct()
    {
        $this->date = new DateTime('now');
        $this->prod = new Msproduct();
        $this->sn = new MsProductionSn();
    }

    public function datatable()
    {
        $datatables = Datatables::method([Msproduct::class, 'getAll'], 'searchable')
            ->setParams(1, 'satu')
            ->make();

        $datatables->updateRow(function ($db, $no) {
            return [
                $no,
                date('d F Y', strtotime($db->orderdate)),
                $db->batchnumber,
                $db->serialnumber,
                "
                <button type='button' class='btn btn-sm btn-warning me-2' onclick=\"editDt('" . $db->id . "', '" . base_url('prod/edit') . "', 'Update')\"><i class='fas fa-pencil fs-7'></i></button>
                <button type='button' class='btn btn-sm btn-danger'><i class='fas fa-trash fs-7'></i></button>
                "
            ];
        });

        $datatables->toJson();
    }

    public function types()
    {
        $type = $this->request->getPost('type');

        if ($type == 1) {
            echo "
                <div class='form-group'>
                    <label class='fw-semibold fs-7'>Serial Number</label>
                    <input type='text' class='form-control form-control-sm' name='serialnum' id='serialnum' placeholder='Serial Number'>
                </div>
            ";
        } else if ($type == 2) {
            echo "
                <div class='form-group'>
                    <div class='row'>
                        <div class='col-lg-4'>
                            <label class='fw-semibold fs-7'>Previx</label>
                            <input type='text' class='form-control form-control-sm' name='previx' id='previx' placeholder='Previx'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='fw-semibold fs-7'>Start</label>
                            <input type='text' class='form-control form-control-sm' name='startnum' id='startnum' placeholder='Start Number'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='fw-semibold fs-7'>QTY</label>
                            <input type='text' class='form-control form-control-sm' name='qty' id='qty' placeholder='Quantity'>
                        </div>
                    </div>
                </div>
            ";
        }
    }

    public function forms()
    {
        $id = $this->request->getPost('id');
        $q = $this->prod->getOne($id);
        if ($id) {
            $data = [
                'ordernum' => $q['ordernumber'],
                'orderdate' => $q['orderdate'],
                'pid' => $q['productid'],
                'batch' => $q['batchnumber'],
                'loc' => $q['location'],
                'profcenter' => $q['profcenter'],
                'serialnum' => $this->sn->getOne($id),
            ];
        }
        echo json_encode($data);
    }

    public function process()
    {
        $res = array();
        $id = $this->request->getPost('idp');
        $ordernum = $this->request->getPost('ordernum');
        $orderdate = $this->request->getPost('orderdate');
        $material = $this->request->getPost('mater');
        $batch = $this->request->getPost('batch');
        $loc = $this->request->getPost('loc');
        $profcenter = $this->request->getPost('profcenter');
        $previx = $this->request->getPost('previx');
        $dtTable = $this->request->getPost('tbl');

        if ($id != '') {
            // Edit Data
            $res = [
                'success' => 1,
                'msg' => 'Selamat Hari Raya',
            ];
        } else {
            // Add Data
            if ($ordernum != '') {
                $data = [
                    'productid' => $material,
                    'ordernumber' => $ordernum,
                    'orderdate' => $orderdate,
                    'batchnumber' => $batch,
                    'location' => $loc,
                    'profcenter' => $profcenter,
                    'createddate' => date('Y-m-d H:i:s'),
                    'createdby' => session()->get('id_user'),
                ];
                $q = $this->prod->tambah($data);
                $idt = db_connect()->insertID();
                if ($q) {
                    if ($previx != '') {
                        for ($a = 0; $a < count($dtTable); $a++) {
                            $data = [
                                'headerid' => $idt,
                                'serialnumber' => $dtTable[$a],
                            ];
                            $this->sn->tambah($data);
                        }
                    } else {
                        for ($a = 0; $a < count($dtTable); $a++) {
                            $dtserial = [
                                'headerid' => $idt,
                                'serialnumber' => $dtTable[$a],
                            ];
                            $this->sn->tambah($dtserial);
                        }
                    }
                    $res = [
                        'success' => 1,
                        'msg' => 'New Data Added',
                    ];
                } else {
                    $res = [
                        'success' => 0,
                        'msg' => 'Data not added',
                    ];
                }
            } else {
                $res = [
                    'success' => 0,
                    'msg' => 'Data Required',
                ];
            }
        }

        echo json_encode($res);
    }
}
