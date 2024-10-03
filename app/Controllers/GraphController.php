<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GraphController extends BaseController
{
    public function index()
    {
        return view('graph/view_graph');
    }
}
