<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msproduct;
use App\Models\Msproduction;
use App\Models\MsProductionSn;
use DateTime;
use Dompdf\Dompdf;
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
        $id = session()->get('id_user');
        if ($id != null) {
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
                <button type='button' class='btn btn-sm btn-danger' onclick=\"hapusModal('Delete Product', 'Are you sure want to delete this product?', '" . $db->productid . "', 'modal-md', '" . base_url('product/delete') . "', 'Delete')\"><i class='fas fa-trash fs-7'></i></button>
                "
            ];
        });

        $datatables->toJson();
    }

    public function getOne()
    {
        $data = array();
        $id = $this->request->getPost('id');
        $header = $this->request->getPost('header');

        if ($id != '') {
            $q = $this->p->getOne($id);
            if ($q) {
                $data = [
                    'pname' => $q['productname'],
                    'partnum' => $q['partnumber'],
                    'img' => $q['image'],
                    'count' => $this->prod->count($header),
                ];
            }
        } else {
            $data = [
                'count' => $this->prod->count($header),
            ];
        }

        echo json_encode($data);
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

    public function delete()
    {
        $id = $this->request->getPost('id');
        if ($id != '') {
            $one = $this->p->getOne($id);
            if (file_exists('public/product_img/' . $one['image'])) {
                unlink('public/product_img/' . $one['image']);
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
                    'msg' => 'Data not deleted',
                ];
            }
        }

        echo json_encode($res);
    }

    public function exPDF($id)
    {
        $res = [];
        $data = $this->prod->getExp($id);
        foreach ($data as $d) {
            array_push($res, [
                'data' => $d,
            ]);
        }

        $view = view('master/produksi/v_pdf', [
            'data' => $res,
            'row' => $this->prod->getHead($id),
        ]);

        $pdf = new Dompdf();
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('data-export', array('attachment' => false));
    }
}
