<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_productos()
    {
        $query = $this->db->get('Vajilla');
        return $query->result(); // Devuelve todos los productos como un array de objetos
    }
    public function get_usuarios()
    {
        $query = $this->db->get('Usuarios');
        return $query->result();
    }
    public function eliminar_usuario($usuario_id)
    {
        return $this->db->delete('Usuarios', array('usuario_id' => $usuario_id));
    }
    public function eliminar_producto($producto_id)
    {
        return $this->db->delete('Vajilla', array('vajilla_id' => $producto_id));
    }

    public function actualizar_producto($producto_id, $data)
    {
        $this->db->where('vajilla_id', $producto_id);
        return $this->db->update('Vajilla', $data);
    }
}
