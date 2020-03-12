<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class rank extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('data_model', 'dmodel');
    }

    //Menampilkan ranking
    function index_get()
    {
        $id = $this->get('clubname');
        if ($id == '') {
            $standing = $this->dmodel->getRank();
        } else {
            $standing = $this->dmodel->getRank($id);
        }
        if ($standing) {
            $this->response($standing, 200);
        } else {
            $this->response(array('status' => 'not found'), 404);
        }
    }
}
