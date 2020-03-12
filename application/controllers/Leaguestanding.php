<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class leaguestanding extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    //Menampilkan data point
    function index_get()
    {
        $id = $this->get('clubname');
        if ($id == '') {
            $score = $this->db->get('point')->result();
        } else {
            $score = $this->db->get_where('point', ['clubname' => $id])->result();
        }
        if ($score) {
            $this->response($score, 200);
        } else {
            $this->response(array('status' => 'not found'), 404);
        }
    }
}
