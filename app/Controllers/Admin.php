<?php

namespace App\Controllers;

use Config\Services;

class Admin extends BaseController
{
    protected $db;
    protected $datatable;
    protected $datatables;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->datatables = $this->db->table('admin');//used to fsave department
        $this->datatable = $this->db->table('student');//used to fetch studnet data

        //extra for COrs suse
        $this->cors = Services::response()
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
            ->setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit(0);
        }

    }
    public function index()
    {
        echo view('template/header');
        echo view('adminpage');
        echo view('template/footer');
    }
    public function add()
    {
        echo view('adddept');
    }
    public function admiSave()
    {

        //for save student data
        $data = $this->request->getVar();
        $this->datatables->insert($data);
        $response = 10;
        echo json_encode($response);

    }
    public function admiData()
    {
        //for get student data to sevrer
        $data = $this->datatable->get()->getResult();

        $tr = "";
        $id = 1;
        foreach ($data as $row) {
            $tr .= '<tr>
            <td>' . $id . '</td>
            <td>' . $row->name . '</td>
            <td>' . $row->number . ' </td>
            <td>' . $row->email . ' </td>
            <td>' . $row->department . '</td>
            <td>
                <button class="btn btn-success approve" data-id="' . $row->id . '"><i class="fa-solid fa-check"></i></button>
                <button class="btn btn-danger reject" data-id="' . $row->id . '"><i class="fa-regular fa-circle-xmark"></i></button>
            </td>
        </tr>';
            $id++;
        }
        echo json_encode($tr);
    }
    public function approve($id)
    {
        $result = $this->datatable->where('id', $id)->update(['status' => 'approved']);
        echo json_encode($result);
    }

    public function reject($id)
    {
        $result = $this->datatable->where('id', $id)->update(['status' => 'pending']);
        echo json_encode($result);
    }
}