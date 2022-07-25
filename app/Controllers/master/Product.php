<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msproduct;
use DateTime;
use Picqer\Barcode\BarcodeGeneratorHTML;

class Product extends BaseController
{
    public function __construct()
    {
        $this->date = new DateTime('now');
        $this->prod = new Msproduct();
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
                            <input type='num' class='form-control form-control-sm' name='startnum' id='startnum' placeholder='Start Number'>
                        </div>
                        <div class='col-lg-4'>
                            <label class='fw-semibold fs-7'>QTY</label>
                            <input type='num' class='form-control form-control-sm' name='qty' id='qty' placeholder='Quantity'>
                        </div>
                    </div>
                </div>
            ";
        }
    }

    public function datatable()
    {
        $datatables = Datatables::method([Msproduct::class, 'getAll'], 'searchable')
            ->setParams(1, 'satu')
            ->make();
        $datatables->updateRow(function ($db, $no) {
            return [
                $no,
                $db->serialnum,
                "
                <button type='button' class='btn btn-sm btn-warning' onclick=\"editData('" . $db->pid . "', 'Update', '" . base_url('prod/editViews') . "')\"><i class='fas fa-pencil fs-7'></i></button>
                <button type='button' class='btn btn-sm btn-danger' onclick=\"hapusModal('Produksi', 'Are you sure want to delete this data?', '" . $db->pid . "', 'modal-md', '" . base_url('prod/delete') . "', 'Delete')\"><i class='fas fa-trash fs-7'></i></button>
                "
            ];
        });

        $datatables->toJson();
    }

    public function forms()
    {
        $id = $this->request->getPost('id');
        $q = $this->prod->getOne($id);
        if ($q) {
            $res = [
                'pid' => $q['pid'],
                'productname' => $q['pname'],
                'partnum' => $q['partnum'],
                'serialnum' => $q['serialnum'],
            ];
        }
        echo json_encode($res);
    }

    public function process()
    {
        $id = $this->request->getPost('idp');
        $ordernum = $this->request->getPost('ordernum');
        $orderdate = $this->request->getPost('orderdate');
        $material = $this->request->getPost('mater');
        $batch = $this->request->getPost('batch');
        $loc = $this->request->getPost('loc');
        $profcenter = $this->request->getPost('profcenter');
        $sn = $this->request->getPost('serialnum');

        if ($id != '') {
            // Edit Data
        } else {
            // Add Data
        }
    }
}
