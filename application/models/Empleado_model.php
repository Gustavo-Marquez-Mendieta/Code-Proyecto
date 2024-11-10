<?php
class Empleado_model extends CI_Model
{

    // Obtener todos los empleados
    public function get_empleados_disponibles($fecha_reserva, $dias, $reserva_actual_id = null)
    {
        // Calcular el rango de fechas para la reserva
        $fecha_inicio = $fecha_reserva;
        $fecha_fin = date('Y-m-d', strtotime($fecha_reserva . ' + ' . ($dias - 1) . ' days'));

        // Obtener empleados ocupados en las fechas dadas
        $subquery = $this->db->select('empleado_id')
            ->from('garzones_reservas')
            ->join('reservas', 'garzones_reservas.reserva_id = reservas.reserva_id')
            ->where('reservas.estado_pago !=', 'cancelado')
            ->where('reservas.estado_pago !=', 'Evento Completado')
            ->where("(
                reservas.fecha_reserva <= '$fecha_fin' 
                AND DATE_ADD(reservas.fecha_reserva, INTERVAL (reservas.dias - 1) DAY) >= '$fecha_inicio'
            )")
            ->get_compiled_select();

        // Si hay una reserva actual, excluir sus garzones de los ocupados
        if ($reserva_actual_id) {
            $subquery = $this->db->select('empleado_id')
                ->from('garzones_reservas')
                ->join('reservas', 'garzones_reservas.reserva_id = reservas.reserva_id')
                ->where('reservas.estado_pago !=', 'cancelado')
                ->where('reservas.estado_pago !=', 'Evento Completado')
                ->where("(
                    reservas.fecha_reserva <= '$fecha_fin' 
                    AND DATE_ADD(reservas.fecha_reserva, INTERVAL (reservas.dias - 1) DAY) >= '$fecha_inicio'
                )")
                ->where('reservas.reserva_id !=', $reserva_actual_id)
                ->get_compiled_select();
        }

        // Consulta principal para obtener empleados disponibles
        $this->db->select('*')
            ->from('empleados')
            ->where('estado', 1)
            ->where("`empleado_id` NOT IN ($subquery)", NULL, FALSE);

        return $this->db->get()->result();
    }

    public function get_all_empleados()
    {
        $this->db->where('estado', 1);
        return $this->db->get('empleados')->result();
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
