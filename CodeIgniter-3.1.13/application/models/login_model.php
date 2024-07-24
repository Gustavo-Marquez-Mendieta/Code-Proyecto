<?php
class Login_model extends CI_Model {

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
    public function validarusuario($usuario, $password)
    {
        // Buscar el usuario en la base de datos
        $this->db->where('usuario', $usuario);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 1) {
            $usuario_db = $query->row();

            // Verificar la contraseña
            if (password_verify($password, $usuario_db->password)) {
                return true;
            }
        }

        return false;
    }
}
