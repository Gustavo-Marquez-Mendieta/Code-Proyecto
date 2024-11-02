<?php
class Manteleria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_all_products()
    {
        $query = $this->db->get('Manteleria');
        return $query->result();
    }
    public function get_all_manteleria()
    {
        $query = $this->db->get('Manteleria');
        return $query->result_array(); // Devuelve los resultados como un array asociativo
    }
    public function get_manteleria_by_id($id)
    {
        return $this->db->where('manteleria_id', $id)->get('Manteleria')->row_array();
    }

    public function update_stock_manteleria($id, $nuevo_stock)
    {
        $this->db->where('manteleria_id', $id)->update('Manteleria', array('stock' => $nuevo_stock));
    }

    // Obtener una decoración por ID


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
    public function incrementar_stock_manteleria($manteleria_id, $cantidad)
    {
        $this->db->set('stock', 'stock + ' . (int) $cantidad, FALSE);
        $this->db->where('manteleria_id', $manteleria_id);
        return $this->db->update('Manteleria');
    }

}
