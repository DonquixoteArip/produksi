<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;

class Produksi extends BaseController
{
    public function __construct()
    {
        helper('form');
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

    public function showTxt()
    {
        $dir    = $this->request->getPost('direct');
        $files = array_diff(scandir($dir, 1), ['..', '.']);

        if ($files > 0) {
            foreach ($files as $f) {
                $myfile = fopen(str_replace(" ", "", "$dir\ $f"), "r") or die("Unable to open file!");
                if (filesize(str_replace(" ", "", "$dir\ $f")) > 0) {
                    echo "
                    <div class='col-lg-4 pb-3 px-2 text-center'>
                        <div class='card bg-success bg-opacity-75'>
                            <a href='#' class='text-decoration-none text-secondary'>
                                <div class='card-body'>
                                    <span class='fs-7 text-white'>" . fread($myfile, filesize(str_replace(" ", "", "$dir\ $f"))) . "</span>
                                </div>
                            </a>
                        </div>
                        <label class='fs-7set fw-semibold text-secondary'>$f</label>
                    </div>
                    ";
                } else {
                    echo "Found file with empty data";
                }
                fclose($myfile);
            }
        } else {
            echo "There is no data in this directory";
        }
    }
}
