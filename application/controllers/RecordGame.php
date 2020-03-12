<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class recordgame extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function index_post()
    {
        $input = $this->post();
        $scorehome = $this->db->get_where('point', ['clubname' => $input['clubhomename']])->row_array();
        $scoreaway = $this->db->get_where('point', ['clubname' => $input['clubawayname']])->row_array();
        $split = explode(":", $input['score']);
        if ($split[0] > $split[1]) {
            $newscorehome = $scorehome['points'] + 3;
            $newscoreaway = $scoreaway['points'] + 0;
        } else if ($split[0] == $split[1]) {
            $newscorehome = $scorehome['points'] + 1;
            $newscoreaway = $scoreaway['points'] + 1;
        } else {
            $newscorehome = $scorehome['points'] + 0;
            $newscoreaway = $scoreaway['points'] + 3;
        }

        if ($scorehome) {
            $this->db->set('points', $newscorehome);
            $this->db->where('clubname', $input['clubhomename']);
            $this->db->update('point');
        } else {
            $data = [
                'clubname' => $input['clubhomename'],
                'points' => $newscorehome
            ];
            $this->db->insert('point', $data);
        }

        if ($scoreaway) {
            $this->db->set('points', $newscoreaway);
            $this->db->where('clubname', $input['clubawayname']);
            $this->db->update('point');
        } else {
            $data = [
                'clubname' => $input['clubawayname'],
                'points' => $newscoreaway
            ];
            $this->db->insert('point', $data);
        }
        $this->response(array('status' => 'success'), 200);
    }
}
