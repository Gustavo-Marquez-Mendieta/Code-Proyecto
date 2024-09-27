<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bebida_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_bebidas()
    {
        $query = $this->db->get('Bebidas');
        return $query->result_array();
    }

    public function get_bebida_by_id($id)
    {
        $query = $this->db->get_where('Bebidas', array('bebida_id' => $id));
        return $query->row_array();
    }

    public function insert_bebida($data)
    {
        return $this->db->insert('Bebidas', $data);
    }

    public function update_bebida($id, $data)
    {
        $this->db->where('bebida_id', $id);
        return $this->db->update('Bebidas', $data);
    }

    public function delete_bebida($id)
    {
        $this->db->where('bebida_id', $id);
        return $this->db->delete('Bebidas');
    }
}
