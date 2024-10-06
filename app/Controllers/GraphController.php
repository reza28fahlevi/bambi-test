<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SahamModel;
use App\Models\TransactionModel;

class GraphController extends BaseController
{
    private $sahamModel, $transactionModel;

    public function __construct()
    {
        $this->sahamModel = new SahamModel();
        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        $data = [
            'saham_list' => $this->sahamModel->orderBy('saham_id','asc')->findAll()
        ];
        return view('graph/view_graph', $data);
    }

    public function getGraph($id = 1)
    {
        $graphData = $this->transactionModel->where('saham_id', $id)->findAll();
        if($graphData){
            foreach($graphData as $data){
                $data->t_time = strtotime(explode('.', $data->t_time)[0]) * 1000;
            }
            // pre($graphData,1);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Success to get data",
                'data' => $graphData
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Failed. Product not found",
            ]);
        }
    }
}
