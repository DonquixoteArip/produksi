<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Models\Msproduct;
use CodeIgniter\Database\Query;

class Produksi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->prod = new Msproduct();
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

    public function compare()
    {
        $dir    = 'D:\haho';
        $files = array_diff(scandir($dir, 1), ['..', '.']);
        $data = array();

        if ($files > 0) {
            foreach ($files as $f) {
                $myfile = fopen(str_replace(" ", "", "$dir\ $f"), "r") or die("Unable to open file!");
                if (filesize(str_replace(" ", "", "$dir\ $f")) > 0) {
                    $res = $this->prod->getCompare(fread($myfile, filesize(str_replace(" ", "", "$dir\ $f"))));
                    if ($res != '') {
                        $data[] = array('data' => $res);
                    } else {
                        $rest = fread($myfile, filesize(str_replace(" ", "", "$dir\ $f")));
                        $data[] = array(
                            'data' => $rest,
                        );
                    }
                }
                fclose($myfile);
            }
        }
        echo json_encode($data);
    }
}
