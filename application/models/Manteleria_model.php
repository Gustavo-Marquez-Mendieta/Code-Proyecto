<?php
class Manteleria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

    // Obtener todas las decoraciones
    public function get_all_manteleria()
    {
        $query = $this->db->get('Manteleria');
        return $query->result_array(); // Devuelve los resultados como un array asociativo
    }

    // Obtener una decoración por ID
    public function get_manteleria_by_id($id)
    {
        $query = $this->db->get_where('Manteleria', array('manteleria_id' => $id));
        return $query->row_array();
    }

    // Actualizar una decoración
    public function update_manteleria($id, $data)
    {
        $this->db->where('manteleria_id', $id);
        return $this->db->update('Manteleria', $data);
    }

    // Eliminar una decoración
    public function delete_manteleria($id)
    {
        $this->db->where('manteleria_id', $id);
        return $this->db->delete('Manteleria');
    }

    public function insert_manteleria($data)
    {
        return $this->db->insert('Manteleria', $data);
    }
    
}
