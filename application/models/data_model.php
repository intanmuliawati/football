<?php
class data_model extends CI_Model
{
    public function getRank($id = null)
    {
        if ($id === null) {
            $hasil = $this->db->query(" select clubname, standing from (select @rownum:=@rownum+1 standing, p.* from point p, (SELECT @rownum:=0) r order by points desc ) q ");
            return $hasil->result_array();
        } else {
            $hasil = $this->db->query("select clubname, standing from (select @rownum:=@rownum+1 standing, p.* from point p, (SELECT @rownum:=0) r order by points desc ) q where clubname = '$id' ");
            return $hasil->result_array();
        }
    }
}
