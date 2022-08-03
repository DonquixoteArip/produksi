<?php

namespace App\Controllers\master;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\History as ModelsHistory;

class History extends BaseController
{
    public function index()
    {
        $id = session()->get('id_user');
        if ($id != null) {
            $data = [
                'title' => 'Data History',
            ];
            return view('master/history/v_history', $data);
        } else {
            return redirect()->to('login');
        }
    }

    public function datatables()
    {
        $datatable = Datatables::method([ModelsHistory::class, 'getAll'], 'searchable')
            ->setParams(1, 'satu')
            ->make();

        $datatable->updateRow(function ($db, $no) {
            return [
                $no,
                $db->prodname,
                $db->partnum,
                $db->ordernum,
                $db->orderdate,
                $db->location,
                $db->profcenter,
                $db->mm,
                $db->batch,
                $db->serialnum,
            ];
        });

        $datatable->toJson();
    }
}
