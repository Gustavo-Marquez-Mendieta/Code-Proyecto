<?php
class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function existeUsuarioPorNombre($nombre)
    {
        $query = $this->db->get_where('usuarios', array('nombre' => $nombre));
        return $query->num_rows() > 0;
    }

    public function existeUsuarioPorCorreo($correo)
    {
        $query = $this->db->get_where('usuarios', array('usuario' => $correo));
        return $query->num_rows() > 0;
    }

    public function existeUsuarioPorCelular($celular)
    {
        $query = $this->db->get_where('usuarios', array('celular' => $celular));
        return $query->num_rows() > 0;
    }

    public function agregarusuario($data)
    {
        return $this->db->insert('usuarios', $data);
    }
    public function validarusuario($user, $password)
    {
        $this->db->where('usuario', $user);
        $query = $this->db->get('Usuarios');  // Asegúrate de que la tabla se llama 'Usuarios'

        if ($query->num_rows() == 1) {
            $row = $query->row();
            if (password_verify($password, $row->password)) {
                return true;
            }
        }
        return false;
    }

    public function obtenerNombreCompleto($user)
    {
        $this->db->where('usuario', $user);
        $query = $this->db->get('Usuarios');
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->nombre;
        }
        return null;
    }
    public function obtenerUsuarioPorEmail($email)
    {
        $this->db->where('usuario', $email);
        $query = $this->db->get('usuarios');
        return $query->row();
    }

}
