<?php

namespace App\Controllers\login;

use App\Controllers\BaseController;
use App\Models\Muser;
use DateTime;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->date = new DateTime('now');
        $this->user = new Muser();
    }

    public function index()
    {
        return view('v_login');
    }

    // Static Create User Login
    // public function usera()
    // {
    //     $data = [
    //         'username' => 'rekso123',
    //         'password' => password_hash('rekso123', PASSWORD_DEFAULT),
    //         'createddate' => date('Y-m-d H:i:s'),
    //         'createdby' => 'admin',
    //         'fullname' => 'Reksho Satriyo',
    //     ];

    //     $this->user->tambah($data);
    // }

    public function auth()
    {
        $res = array();
        $username = $this->request->getPost('uname');
        $password = $this->request->getPost('pass');
        $query = $this->user->cek($username);

        if ($username != '' && $password != '') {
            if ($query) {
                if (password_verify($password, rtrim($query['password']))) {
                    session()->set('id_user', $query['userid']);
                    session()->set('name', $query['fullname']);
                    session()->set('logged_in', TRUE);
                    $res = [
                        'success' => 1,
                        'msg' => "Login Success",
                    ];
                } else {
                    $res['success'] = 0;
                    $res['msg'] = 'Wrong Password';
                }
            } else {
                $res = [
                    'success' => 0,
                    'msg' => 'Username or Password not registered',
                ];
            }
        } else {
            $res = [
                'success' => 0,
                'msg' => 'Username and Password required!',
            ];
        }

        echo json_encode($res);
    }

    public function logout()
    {
        $data = [
            'last_login' => date('Y-m-d H:i:s'),
        ];
        $q = $this->user->edit($data, session()->get('id_user'));
        if ($q) {
            session()->destroy();
        }
        return redirect()->to('login');
    }
}
