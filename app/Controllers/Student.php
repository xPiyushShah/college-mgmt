<?php

namespace App\Controllers;

use Config\Services;

class Student extends BaseController
{
    protected $db;
    protected $datatable;
    protected $datatables;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->datatable = $this->db->table('student');
        $this->datatables = $this->db->table('admin');


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
        echo view('studentpage');
        echo view('template/footer');
    }
    public function fetch()
    {
        $query  = $this->datatables->get(); 
        $data = $query->getResultArray();
        echo json_encode($data);
    }
    public function add()
    {
        echo view('addstu');
    }
    public function stuSave()
    {

        //for save student data
        $data = $this->request->getVar();
        $this->datatable->insert($data);
        $response = 10;
        echo json_encode($response);

    }
    public function stuData()
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
            <td>' . $row->gender . '</td>
            <td>' . $row->department . '</td>
            <td>' . $row->status . '</td>
        </tr>';
            $id++;
        }
        echo json_encode($tr);
    }
}