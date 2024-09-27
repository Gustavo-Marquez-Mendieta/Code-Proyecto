<?php
class Empleado_model extends CI_Model
{

    // Obtener todos los empleados
    public function get_all_empleados()
    {
        $query = $this->db->get('Empleados');
        return $query->result();
    }
    public function insert_empleado($data)
    {
        $this->db->insert('Empleados', $data);
    }

    // Obtener empleado por ID
    public function get_empleado_by_id($empleado_id)
    {
        $this->db->where('empleado_id', $empleado_id);
        $query = $this->db->get('Empleados');
        return $query->row();
    }

    // Actualizar empleado
    public function update_empleado($empleado_id, $data)
    {
        $this->db->where('empleado_id', $empleado_id);
        $this->db->update('Empleados', $data);
    }

    // Eliminar empleado
    public function delete_empleado($empleado_id)
    {
        $this->db->where('empleado_id', $empleado_id);
        $this->db->delete('Empleados');
    }
    public function celular_existe($celular)
    {
        $this->db->where('celular', $celular);
        $query = $this->db->get('Empleados');
        return $query->num_rows() > 0;
    }

    // Verificar si el nombre completo ya existe
    public function nombre_existe($nombre, $apellido_paterno, $apellido_materno)
    {
        $this->db->where('nombre', $nombre);
        $this->db->where('apellido_paterno', $apellido_paterno);
        $this->db->where('apellido_materno', $apellido_materno);
        $query = $this->db->get('Empleados');
        return $query->num_rows() > 0;
    }
}
