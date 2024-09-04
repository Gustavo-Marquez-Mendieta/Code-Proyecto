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

    // Obtener un producto de la tabla 'decoraciones'
    public function get_decoracion_by_id($producto_id)
    {
        $this->db->where('decoracion_id', $producto_id);
        $query = $this->db->get('decoraciones');
        return $query->row_array();
    }
    // Obtiene todos los productos del carrito
    // Obtener el carrito de la sesión
    public function obtener_carrito()
    {
        return $this->session->userdata('carrito') ?: array();
    }

    // Eliminar un producto del carrito

    // Vaciar el carrito
    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito'); // Vacía el carrito de la sesión
    }
    public function update_stock_vajilla($producto_id, $nuevo_stock)
    {
        $this->db->set('stock_cajas', $nuevo_stock);
        $this->db->where('vajilla_id', $producto_id); // Asegúrate de que 'vajilla_id' sea el nombre correcto del campo en tu tabla
        return $this->db->update('Vajilla');
    }


}
