<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SahamModel;
use App\Models\TransactionModel;

class TransactionController extends BaseController
{
    private $model, $sahamModel;

    public function __construct()
    {
        $this->model = new TransactionModel();
        $this->sahamModel = new SahamModel();
    }
    public function index()
    {
        $data = [
            'saham_list' => $this->sahamModel->findAll()
        ];
        return view('Transaction/view_transaction', $data);
    }

    public function fetch(){
        // Read the parameters sent by DataTables
        $start = (int) $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $search = $this->request->getPost('search')['value'];

        // Get the total number of records (including soft deleted)
        $totalRecords = $this->model->withDeleted()->countAllResults();

        // Get the total number of filtered records (excluding soft deleted)
        if (!empty($search)) {
            $this->model->like('idx_saham', $search);
        }
        $totalFilteredRecords = $this->model->countAllResults(false);

        // Fetch the data (excluding soft deleted)
        if (!empty($search)) {
            $this->model->like('idx_saham', $search);
        }
        $data = $this->model->orderBy('t_time', 'desc')->findAll($length, $start);

        // Prepare the response
        $response = [
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFilteredRecords,
            "data" => $data
        ];

        return $this->response->setJSON($response);
    }
    
    public function add()
    {
        $error = "";
        // Get form data
        $saham_id = htmlspecialchars((string)$this->request->getPost('saham_id'),ENT_QUOTES);
        $saham = $this->sahamModel->find($saham_id);
        $idx_saham = "";
        if($saham) $idx_saham = $saham->idx_saham;
        $open = htmlspecialchars((string)$this->request->getPost('topen'),ENT_QUOTES);
        $high = htmlspecialchars((string)$this->request->getPost('thigh'),ENT_QUOTES);
        $low = htmlspecialchars((string)$this->request->getPost('tlow'),ENT_QUOTES);
        $close = htmlspecialchars((string)$this->request->getPost('tclose'),ENT_QUOTES);

        // Prepare data for insertion
        $data = [
            'saham_id' => $saham_id,
            'idx_saham' => $idx_saham,
            'topen' => ($open) ? $open : 0,
            'thigh' => ($high) ? $high : 0,
            'tlow' => ($low) ? $low : 0,
            'tclose' => ($close) ? $close : 0,
            't_time' => date('Y-m-d H:i:s'),
        ];

        // pre($data,1);
        // Insert data into the database
        $insert = $this->model->insert($data);
        if ($insert) {
            return $this->response->setJSON([
                'status' => 'success',
                'error' => $error,
                'message' => "Successfully added",
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'error' => $error,
                'message' => "Failed to add",
            ]);
        }
    }
}
