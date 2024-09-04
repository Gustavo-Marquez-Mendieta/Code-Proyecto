<?php
class Decoracion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Obtener todas las decoraciones
    public function get_all_decoraciones()
    {
        $query = $this->db->get('Decoraciones');
        return $query->result_array(); // Devuelve los resultados como un array asociativo
    }

    // Obtener una decoración por ID
    public function get_decoracion_by_id($id)
    {
        $query = $this->db->get_where('Decoraciones', array('decoracion_id' => $id));
        return $query->row_array();
    }

    // Actualizar una decoración
    public function update_decoracion($id, $data)
    {
        $this->db->where('decoracion_id', $id);
        return $this->db->update('Decoraciones', $data);
    }

    // Eliminar una decoración
    public function delete_decoracion($id)
    {
        $this->db->where('decoracion_id', $id);
        return $this->db->delete('Decoraciones');
    }

    public function insert_decoracion($data)
    {
        return $this->db->insert('Decoraciones', $data);
    }
    
}
