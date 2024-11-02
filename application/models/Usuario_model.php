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
    public function get_usuario($id)
    {
        $query = $this->db->get_where('usuarios', array('usuario_id' => $id));
        return $query->row(); // Asegúrate de que devuelve un objeto
    }
    public function get_usuario_by_id($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('Usuarios');
        return $query->row(); // Devuelve una sola fila como un objeto
    }


    public function actualizar_usuario($usuario_id, $data)
    {
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('usuarios', $data);
    }


    public function eliminar_usuario($usuario_id)
    {
        $data = array('estado' => 0);
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('Usuarios', $data);
    }
    public function activar_usuario($usuario_id)
    {
        $data = array(
            'estado' => 1 // Cambiar el estado a activo (1)
        );

        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('Usuarios', $data); // Asegúrate de que el nombre de la tabla es correcto
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

    public function getUserById($usuario_id)
    {
        $query = $this->db->get_where('Usuarios', array('usuario_id' => $usuario_id));
        return $query->row();
    }


    public function updateUser($usuario_id, $data)
    {
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->update('Usuarios', $data);
    }
}
