<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reservas_model extends CI_Model
{
    public function guardar_reserva($usuario_id, $fecha_reserva, $tipo_evento, $dias, $monto_total, $detalle_evento, $garzones_value)
    {
        $data = array(
            'usuario_id' => $usuario_id,
            'fecha_reserva' => $fecha_reserva,
            'tipo_evento' => $tipo_evento,
            'dias' => $dias,
            'monto_total' => $monto_total,
            'estado_pago' => 'Pendiente',
            'detalle_evento' => $detalle_evento,
            'garzones' => $garzones_value // Aquí se almacena la cantidad o 'no'
        );

        $this->db->insert('reservas', $data);
        return $this->db->insert_id(); // Devuelve el ID de la reserva creada
    }



    public function verificar_disponibilidad_fecha($fecha_reserva, $dias)
    {
        // Calcula la fecha final de la nueva reserva
        $fecha_final = date('Y-m-d', strtotime($fecha_reserva . ' + ' . ($dias - 1) . ' days'));

        // Consulta para encontrar reservas que se solapen con la nueva reserva
        $this->db->where('(fecha_reserva <= "' . $fecha_final . '" 
                       AND DATE_ADD(fecha_reserva, INTERVAL dias - 1 DAY) >= "' . $fecha_reserva . '")');
        $query = $this->db->get('reservas');

        return $query->num_rows() > 0;
    }
    public function get_all_reservas()
    {
        $this->db->select('Reservas.*, Usuarios.nombre AS usuario_nombre');
        $this->db->from('Reservas');
        $this->db->join('Usuarios', 'Reservas.usuario_id = Usuarios.usuario_id');
        $query = $this->db->get();

        return $query->result();
    }
    public function get_reserva_by_id($reserva_id)
    {
        $this->db->where('reserva_id', $reserva_id);
        $query = $this->db->get('Reservas');
        return $query->row();
    }
    public function update_estado_reserva($reserva_id, $nuevo_estado, $usuario_id_aprobador = null)
    {
        // Preparar los datos a actualizar
        $data = array(
            'estado_pago' => $nuevo_estado // Asegúrate de que este nombre de campo sea el correcto
        );

        // Solo agregar 'aprobado_por' si se proporciona un ID de usuario aprobador
        if ($usuario_id_aprobador !== null) {
            $data['aprobado_por'] = $usuario_id_aprobador;
        }

        // Actualizar la reserva en la base de datos
        $this->db->where('reserva_id', $reserva_id);
        $this->db->update('Reservas', $data);
    }

    public function get_reserva_con_usuario_by_id($reserva_id)
    {
        $this->db->select('Reservas.reserva_id, Usuarios.usuario AS email');
        $this->db->from('Reservas');
        $this->db->join('Usuarios', 'Reservas.usuario_id = Usuarios.usuario_id');
        $this->db->where('Reservas.reserva_id', $reserva_id);
        $query = $this->db->get();
        return $query->row(); // Devuelve un objeto con los detalles de la reserva y el correo del usuario
    }


    public function get_detalles_by_reserva($reserva_id)
    {
        $this->db->select('Reserva_detalle.*, Vajilla.nombre AS vajilla_nombre, Vajilla.tipo AS vajilla_tipo, Vajilla.precio AS vajilla_precio, 
                               Decoraciones.plan AS decoracion_plan, Decoraciones.tipo AS decoracion_tipo, Decoraciones.precio AS decoracion_precio');
        $this->db->from('Reserva_detalle');
        $this->db->join('Vajilla', 'Reserva_detalle.vajilla_id = Vajilla.vajilla_id', 'left');
        $this->db->join('Decoraciones', 'Reserva_detalle.decoracion_id = Decoraciones.decoracion_id', 'left');
        $this->db->where('Reserva_detalle.reserva_id', $reserva_id);

        $query = $this->db->get();
        return $query->result();
    }

}