<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msproduct;
use App\Models\Msproduction;
use App\Models\MsProductionSn;
use DateTime;
use Picqer\Barcode\BarcodeGeneratorHTML;

class Product extends BaseController
{
    public function __construct()
    {
        $this->date = new DateTime('now');
        $this->p = new Msproduct();
        $this->prod = new Msproduction();
        $this->sn = new MsProductionSn();
    }

    public function index()
    {
        if (session()->get('id_user') != '') {
            $data = [
                'title' => 'Data Product',
            ];
            return view('master/product/v_product', $data);
        } else {
            return redirect()->to('login');
        }
    }

    public function datatables()
    {
        $datatables = Datatables::method([Msproduct::class, 'getAll'], 'searchable')
            ->setParams(1, 'satu')
            ->make();

        $datatables->updateRow(function ($db, $no) {
            return [
                $no,
                $db->partnumber,
                $db->productname,
                "
                    <button type='button' class='btn btn-sm btn-warning' onclick=\"editProd('" . $db->productid . "', '" . base_url('product/process') . "', 'Update Product','Update')\"><i class='fas fa-pencil fs-7'></i></button>
                    <button type='button' class='btn btn-sm btn-danger'><i class='fas fa-trash fs-7'></i></button>
                    "
            ];
        });

        $datatables->toJson();
    }

    public function formViews()
    {
        $data = array();
        $id = $this->request->getPost('id');
        if ($id != '') {
            $q = $this->p->getOne($id);
            $dt = [
                'type' => 'edit',
                'row' => $q,
            ];
            $data['view'] = view('master/product/v_form', $dt);
        } else {
            $dt = [
                'type' => 'add',
            ];
            $data['view'] = view('master/product/v_form', $dt);
        }

        echo json_encode($data);
    }

    public function process()
    {
        $res = array();
        $id = $this->request->getPost('idp');
        $name = '';
        $partnum = $this->request->getPost('partnum');
        $productname = $this->request->getPost('productname');
        $productimg = $this->request->getFile('productimg');
        if ($productimg != '') {
            if ($partnum != '' && $productname != '') {
                if ($id == '') {
                    $name = $productimg->getRandomName();
                    $productimg->move('public/product_img/', $name);
                    $data = [
                        'partnumber' => $partnum,
                        'productname' => $productname,
                        'image' => $name,
                        'createddate' => date('Y-m-d H:i:s'),
                        'createdby' => session()->get('id_user'),
                    ];

                    $q = $this->p->tambah($data);
                    if ($q) {
                        $res = [
                            'success' => 1,
                            'msg' => 'New Data Added',
                        ];
                    } else {
                        $res = [
                            'success' => 0,
                            'msg' => 'Query Fatal Error',
                        ];
                    }
                } else {
                    $one = $this->p->getOne($id);
                    if (file_exists('public/product_img/' . $one['image'])) {
                        unlink('public/product_img/' . $one['image']);
                    }
                    $names = $productimg->getRandomName();
                    $data = [
                        'partnumber' => $partnum,
                        'productname' => $productname,
                        'image' => $names,
                    ];

                    $productimg->move('public/product_img/', $names);
                    $this->p->edit($data, $id);
                    $res = [
                        'success' => 1,
                        'msg' => 'Updating Data Success',
                    ];
                }
            }
        } else {
            $res = [
                'success' => 0,
                'msg' => 'Product Image Required',
            ];
        }

        echo json_encode($res);
    }

    public function hapus()
    {
        $id = $this->request->getPost('id');
        if ($id != '') {
            $one = $this->p->getOne($id);
            if (file_exists('public/product_img/' . $one['image'])) {
                unlink('public/product_img' . $one['image']);
            }
            $q = $this->p->hapus($id);
            if ($q) {
                $res = [
                    'success' => 1,
                    'msg' => 'Data Deleted',
                ];
            } else {
                $res = [
                    'success' => 0,
                    'msg' => 'Err',
                ];
            }
        }
    }
}
