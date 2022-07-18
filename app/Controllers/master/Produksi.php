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
}
