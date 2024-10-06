<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SahamModel;

class SahamController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new SahamModel();
    }
    public function index()
    {
        $data = [];
        return view('Saham/view_saham', $data);
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
        $data = $this->model->orderBy('idx_saham', 'desc')->findAll($length, $start);

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
        $idx_saham = htmlspecialchars((string)$this->request->getPost('idx_saham'),ENT_QUOTES);
        $nama_perusahaan = htmlspecialchars((string)$this->request->getPost('nama_perusahaan'),ENT_QUOTES);
        $harga_ipo = htmlspecialchars((string)$this->request->getPost('harga_ipo'),ENT_QUOTES);

        // Prepare data for insertion
        $data = [
            'idx_saham' => $idx_saham,
            'nama_perusahaan' => $nama_perusahaan,
            'harga_ipo' => $harga_ipo,
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

    
    public function getData($id){
        $saham = $this->model->find($id);

        if($saham){
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Success to get data",
                'data' => $saham
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Failed. Product not found",
            ]);
        }
    }

    public function update()
    {
        $error = "";
        $id = $this->request->getPost('saham_id');

        $idx_saham = htmlspecialchars((string)$this->request->getPost('idx_sa$idx_saham'),ENT_QUOTES);
        $nama_perusahaan = htmlspecialchars((string)$this->request->getPost('nama_perusahaan'),ENT_QUOTES);
        $harga_ipo = htmlspecialchars((string)$this->request->getPost('harga$harga_ipo'),ENT_QUOTES);

        // Prepare data for insertion
        $data = [
            'idx_saham' => $idx_saham,
            'nama_perusahaan' => $nama_perusahaan,
            'harga_ipo' => $harga_ipo,
        ];

        if ($this->model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'error' => $error,
                'message' => "Successfully updated",
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'error' => $error,
                'message' => "Failed to update",
            ]);
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id'); // Get the ID from the AJAX request
        
        // Check if the saham exists
        $saham = $this->model->find($id);
        if (!$saham) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Saham not found']);
        }

        // Delete
        if ($this->model->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Saham deleted successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete Saham']);
        }
    }
}
