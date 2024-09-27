<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Obtiene un producto por su ID
    public function get_vajilla_by_id($producto_id)
    {
        $this->db->where('vajilla_id', $producto_id);
        $query = $this->db->get('vajilla');
        return $query->row_array();
    }

    public function get_manteleria_by_id($producto_id)
    {
        $this->db->where('manteleria_id', $producto_id);
        $query = $this->db->get('manteleria');
        return $query->row_array();
    }

    public function obtener_carrito()
    {
        return $this->session->userdata('carrito') ?: array();
    }


    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito');
    }
    public function update_stock_vajilla($producto_id, $nuevo_stock)
    {
        $this->db->set('stock_cajas', $nuevo_stock);
        $this->db->where('vajilla_id', $producto_id);
        return $this->db->update('Vajilla');
    }
    public function update_stock_manteleria($producto_id, $nuevo_stock)
    {
        $this->db->set('stock', $nuevo_stock);
        $this->db->where('manteleria_id', $producto_id);
        return $this->db->update('Manteleria');
    }


}
