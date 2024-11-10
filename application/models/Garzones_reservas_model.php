<?php
class Garzones_reservas_model extends CI_Model
{
    public function insert_garzon_reserva($reserva_id, $empleado_id)
    {
        $data = [
            'reserva_id' => $reserva_id,
            'empleado_id' => $empleado_id
        ];
        return $this->db->insert('Garzones_Reservas', $data);
    }
    public function garzon_existe_en_reserva($reserva_id, $empleado_id)
    {
        $this->db->where('reserva_id', $reserva_id);
        $this->db->where('empleado_id', $empleado_id);
        $query = $this->db->get('Garzones_Reservas');

        return $query->num_rows() > 0;  // Si existe, retorna true
    }
    public function obtener_garzones_por_reserva($reserva_id)
    {
        $this->db->select('empleados.empleado_id, empleados.nombre, empleados.apellido_paterno, empleados.apellido_materno, empleados.celular');
        $this->db->from('garzones_reservas');
        $this->db->join('empleados', 'garzones_reservas.empleado_id = empleados.empleado_id');
        $this->db->where('garzones_reservas.reserva_id', $reserva_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function eliminar_garzon_reserva($empleado_id, $reserva_id)
    {
        $this->db->where('empleado_id', $empleado_id);
        $this->db->where('reserva_id', $reserva_id);
        return $this->db->delete('garzones_reservas');
    }
}