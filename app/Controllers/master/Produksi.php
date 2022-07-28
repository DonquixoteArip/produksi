<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msproduction;
use App\Models\MsProductionSn;
use DateTime;

class Produksi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->date = new DateTime('now');
        $this->sn = new MsProductionSn();
        $this->prod = new Msproduction();
    }

    public function index()
    {
        if (session()->get('id_user') != '') {
            $data = [
                'title' => 'Produksi',
            ];
            return view('master/produksi/v_produksi', $data);
        } else {
            return redirect()->to('login');
        }
    }

    public function datatable()
    {
        $datatables = Datatables::method([Msproduction::class, 'getAll'], 'searchable')
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

    public function count()
    {
        echo $this->prod->count();
    }

    public function load()
    {
        $query = $this->prod->getData();
        foreach ($query as $q) {
            echo "
            <div class='col-lg-4 pb-3 px-2 text-center'>
                <div class='card bg-secondary bg-opacity-75 elem_compare' id='" . $q['serialnumber'] . "'>
                    <a href='#' class='text-decoration-none text-secondary'>
                        <div class='card-body'>
                            <span class='fs-7 text-white'>" . $q['serialnumber'] . "</span>
                        </div>
                    </a>
                </div>
                <label class='fs-7set fw-semibold text-secondary'>" . $q['ordernumber'] . "</label>
            </div>
            ";
        }
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
            if ($ordernum != '' && $orderdate != '' && $material != '' && $batch != '') {
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

    public function compare()
    {
        $dir    = 'D:\haho';
        $files = array_diff(scandir($dir, 1), ['..', '.']);
        $data = array();

        foreach ($files as $f) {
            echo (pathinfo(str_replace(" ", "", "$dir\ $f"), PATHINFO_EXTENSION) != 'txt');
        }
        // if ($files > 0) {
        //     foreach ($files as $f) {
        //         $myfile = fopen(str_replace(" ", "", "$dir\ $f"), "r") or die("Unable to open file!");
        //         if (filesize(str_replace(" ", "", "$dir\ $f")) > 0) {
        //             $res = $this->prod->getCompare(fread($myfile, filesize(str_replace(" ", "", "$dir\ $f"))));
        //             if ($res != '') {
        //                 $data[] = array(
        //                     'data' => $res,
        //                 );
        //             }
        //         }
        //         fclose($myfile);
        //     }
        //     echo json_encode($data);
        // }
    }

    // public function saveComp()
    // {
    //     $path = base_url('public/product');
    //     $date = date('Y-m-d-H:i:s');

    //     $q = mkdir($path . $date, 0777, true);
    //     if ($q) {
    //         echo 1;
    //     } else {
    //         echo $path . $date;
    //     }
    // }
}
