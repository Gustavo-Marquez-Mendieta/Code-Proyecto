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
    public function get_producto_by_id($producto_id)
    {
        $this->db->where('decoracion_id', $producto_id);
        $query = $this->db->get('decoraciones');
        return $query->row_array(); // Asegúrate de que esto devuelve un array
    }

    // Obtiene todos los productos del carrito
    public function obtener_carrito()
    {
        return $this->session->userdata('carrito') ?: array(); // Asegúrate de que devuelva un array
    }

    // Elimina un producto del carrito
    public function eliminar_del_carrito($producto_id)
    {
        $carrito = $this->session->userdata('carrito');

        if (is_array($carrito) && isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
            $this->session->set_userdata('carrito', $carrito);
        }
    }

    // Limpia el carrito
    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito');
    }
}
