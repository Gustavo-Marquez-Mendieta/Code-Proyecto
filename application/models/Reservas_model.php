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
    public function get_reservas_by_estado($estado)
    {
        $this->db->where('estado_pago', $estado);
        $query = $this->db->get('reservas');
        return $query->result();
    }
    public function update_estado_reserva($reserva_id, $nuevo_estado, $usuario_id_aprobador = null)
    {
        $data = array(
            'estado_pago' => $nuevo_estado
        );

        if ($usuario_id_aprobador !== null) {
            $data['aprobado_por'] = $usuario_id_aprobador;
        }

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
        return $query->row();
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
    public function update_estado_entrega_vajilla($reserva_id, $nuevo_estado, $usuario_id_entregador)
    {
        $fecha_actual = date('Y-m-d H:i:s');

        $data = array(
            'estado_pago' => $nuevo_estado,
            'fecha_entrega_vajilla' => $fecha_actual,
            'entregado_por' => $usuario_id_entregador
        );

        $this->db->where('reserva_id', $reserva_id);
        $this->db->update('Reservas', $data);
    }
    public function update_estado_recogida_vajilla($reserva_id, $nuevo_estado, $detalles_recogida, $usuario_id_recogedor)
    {
        $fecha_actual = date('Y-m-d H:i:s');
        $data = array(
            'estado_pago' => $nuevo_estado,
            'fecha_recogida_vajilla' => $fecha_actual,
            'recogido_por' => $usuario_id_recogedor,
            'detalles' => $detalles_recogida // Guardar los detalles de la recogida
        );

        $this->db->where('reserva_id', $reserva_id);
        $this->db->update('Reservas', $data);
    }

    public function obtener_eventos_empleado($empleado_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('r.tipo_evento, r.fecha_reserva, r.detalle_evento, gr.empleado_id'); // Agregamos el empleado_id
        $this->db->from('Reservas r');
        $this->db->join('garzones_reservas gr', 'gr.reserva_id = r.reserva_id');
        $this->db->where('gr.empleado_id', $empleado_id);
        $this->db->where('r.fecha_reserva >=', $fecha_inicio);
        $this->db->where('r.fecha_reserva <=', $fecha_fin);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_empleados()
    {
        $this->db->select('*');
        $this->db->from('Empleados');
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_empleado_por_id($empleado_id)
    {
        $this->db->select('nombre, apellido_paterno, apellido_materno');
        $this->db->from('Empleados');
        $this->db->where('empleado_id', $empleado_id);
        $query = $this->db->get();
        return $query->row();  // Retorna un único resultado (un empleado)
    }
    public function obtener_nombre_empleado($empleado_id)
    {
        $this->db->select('nombre, apellido_paterno, apellido_materno');
        $this->db->from('Empleados');
        $this->db->where('empleado_id', $empleado_id);
        $query = $this->db->get();
        return $query->row();  // Retorna un único resultado (un empleado)
    }
    public function obtener_eventos_por_tipo($tipo_evento, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('r.tipo_evento, r.fecha_reserva, r.dias, r.monto_total, r.estado_pago, r.garzones, u.nombre AS aprobado_por, r.detalle_evento');
        $this->db->from('Reservas r');
        $this->db->join('Usuarios u', 'r.aprobado_por = u.usuario_id', 'left');
        $this->db->where('r.tipo_evento', $tipo_evento);
        $this->db->where('r.fecha_reserva >=', $fecha_inicio);
        $this->db->where('r.fecha_reserva <=', $fecha_fin);
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_reservas_por_fechas($fecha_inicio, $fecha_fin)
    {
        $this->db->select('r.*, u_aprobado.nombre AS aprobado_por_nombre, 
                       u_entregado.nombre AS entregado_por_nombre, 
                       u_recogido.nombre AS recogido_por_nombre');
        $this->db->from('Reservas r');
        $this->db->join('Usuarios u_aprobado', 'r.aprobado_por = u_aprobado.usuario_id', 'left');
        $this->db->join('Usuarios u_entregado', 'r.entregado_por = u_entregado.usuario_id', 'left');
        $this->db->join('Usuarios u_recogido', 'r.recogido_por = u_recogido.usuario_id', 'left');
        $this->db->where('r.fecha_reserva >=', $fecha_inicio);
        $this->db->where('r.fecha_reserva <=', $fecha_fin);
        $query = $this->db->get();
        return $query->result();
    }

}