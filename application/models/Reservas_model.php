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

    public function get_detalles_reserva($reserva_id)
    {
        $this->db->select('d.detalle_id, d.cantidad, d.vajilla_id, d.manteleria_id, v.nombre AS vajilla_nombre, m.nombre AS manteleria_nombre');
        $this->db->from('reserva_detalles d');
        $this->db->join('Vajilla v', 'v.vajilla_id = d.vajilla_id', 'left');
        $this->db->join('Manteleria m', 'm.manteleria_id = d.manteleria_id', 'left');
        $this->db->where('d.reserva_id', $reserva_id);
        return $this->db->get()->result();
    }


    public function verificar_disponibilidad_fecha($fecha_reserva, $dias)
    {
        $fecha_final = date('Y-m-d', strtotime($fecha_reserva . ' + ' . ($dias - 1) . ' days'));
        $this->db->select('COUNT(*) as total');
        $this->db->from('reservas');
        $this->db->where('(fecha_reserva <= "' . $fecha_final . '" 
                        AND DATE_ADD(fecha_reserva, INTERVAL dias - 1 DAY) >= "' . $fecha_reserva . '")');
        $this->db->where('estado_pago !=', 'cancelado');
        $this->db->where('estado_pago !=', 'Evento Completado');
        $this->db->where('garzones >', 0); 
        $query = $this->db->get();
        $resultado = $query->row();
        return $resultado->total >= 2;
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
    public function getEventosPorMes()
    {
        // Consulta para obtener la cantidad de eventos por mes
        $query = $this->db->query("
            SELECT MONTH(fecha_reserva) as mes, COUNT(*) as cantidad
            FROM Reservas
            WHERE YEAR(fecha_reserva) = YEAR(CURDATE())
            GROUP BY MONTH(fecha_reserva)
            ORDER BY MONTH(fecha_reserva)
        ");

        // Formatear los resultados para que todos los meses estén presentes
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        // Inicializar todos los meses con 0
        $resultados = [];
        foreach ($meses as $numero => $nombre) {
            $resultados[$numero] = [
                'mes' => $nombre,
                'cantidad' => 0
            ];
        }

        // Rellenar los meses con los datos de la consulta
        foreach ($query->result() as $row) {
            $resultados[$row->mes]['cantidad'] = $row->cantidad;
        }

        // Reindexar para obtener un arreglo simple
        return array_values($resultados);
    }

    public function contar_reservas_con_garzones($fecha_reserva, $dias)
    {
        $fecha_inicio = $fecha_reserva;
        $fecha_fin = date('Y-m-d', strtotime($fecha_reserva . ' + ' . ($dias - 1) . ' days'));

        $this->db->select('COUNT(*) as total');
        $this->db->from('reservas');
        $this->db->where('estado_pago !=', 'cancelado');
        $this->db->where('estado_pago !=', 'Evento Completado');
        $this->db->where('garzones >', 0); // Solo contar reservas que tienen garzones

        // Verificar solapamiento de fechas
        $this->db->where("(
            (fecha_reserva <= '$fecha_fin' AND DATE_ADD(fecha_reserva, INTERVAL dias-1 DAY) >= '$fecha_inicio')
        )");

        $result = $this->db->get()->row();
        return $result->total;
    }


    public function obtener_eventos_empleado($empleado_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('r.tipo_evento, r.fecha_reserva, r.detalle_evento, gr.empleado_id, r.dias'); // Agregamos el empleado_id
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
        $this->db->select('r.reserva_id, r.tipo_evento, r.fecha_reserva, r.dias, r.monto_total, r.estado_pago, 
                   r.garzones, r.detalle_evento, r.fecha_entrega_vajilla, r.fecha_recogida_vajilla,
                   u_aprobado.nombre AS aprobado_por, 
                   u_aprobado.primerApellido AS aprobado_primerApellido,
                   u_aprobado.segundoApellido AS aprobado_segundoApellido,
                   u_cliente.nombre AS cliente_nombre, 
                   u_cliente.primerApellido AS cliente_primerApellido, 
                   u_cliente.segundoApellido AS cliente_segundoApellido,
                   u_entregado.nombre AS entregado_nombre,
                   u_entregado.primerApellido AS entregado_primerApellido,
                   u_entregado.segundoApellido AS entregado_segundoApellido,
                   u_recogido.nombre AS recogido_nombre,
                   u_recogido.primerApellido AS recogido_primerApellido,
                   u_recogido.segundoApellido AS recogido_segundoApellido');
        $this->db->from('Reservas r');
        $this->db->join('Usuarios u_aprobado', 'r.aprobado_por = u_aprobado.usuario_id', 'left');
        $this->db->join('Usuarios u_cliente', 'r.usuario_id = u_cliente.usuario_id', 'left');
        $this->db->join('Usuarios u_entregado', 'r.entregado_por = u_entregado.usuario_id', 'left');
        $this->db->join('Usuarios u_recogido', 'r.recogido_por = u_recogido.usuario_id', 'left');
        $this->db->where('r.tipo_evento', $tipo_evento);
        $this->db->where('r.fecha_reserva >=', $fecha_inicio);
        $this->db->where('r.fecha_reserva <=', $fecha_fin);
        $this->db->order_by('r.fecha_reserva', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    // Método adicional para obtener los detalles de una reserva específica
    public function obtener_detalles_tipo($reserva_id)
    {
        // Obtener los detalles de la reserva
        $this->db->select('r.*, 
                     u_cliente.nombre AS cliente_nombre, 
                     u_cliente.primerApellido AS cliente_primerApellido, 
                     u_cliente.segundoApellido AS cliente_segundoApellido,
                     u_aprobado.nombre AS aprobado_nombre,
                     u_aprobado.primerApellido AS aprobado_primerApellido,
                     u_aprobado.segundoApellido AS aprobado_segundoApellido,
                     u_entregado.nombre AS entregado_nombre,
                     u_entregado.primerApellido AS entregado_primerApellido,
                     u_entregado.segundoApellido AS entregado_segundoApellido,
                     u_recogido.nombre AS recogido_nombre,
                     u_recogido.primerApellido AS recogido_primerApellido,
                     u_recogido.segundoApellido AS recogido_segundoApellido');
        $this->db->from('Reservas r');
        $this->db->join('Usuarios u_cliente', 'r.usuario_id = u_cliente.usuario_id', 'left');
        $this->db->join('Usuarios u_aprobado', 'r.aprobado_por = u_aprobado.usuario_id', 'left');
        $this->db->join('Usuarios u_entregado', 'r.entregado_por = u_entregado.usuario_id', 'left');
        $this->db->join('Usuarios u_recogido', 'r.recogido_por = u_recogido.usuario_id', 'left');
        $this->db->where('r.reserva_id', $reserva_id);
        $reserva = $this->db->get()->row();

        if ($reserva) {
            // Obtener los detalles de vajilla y mantelería
            $this->db->select('rd.*, v.nombre as nombre_vajilla, m.nombre as nombre_manteleria');
            $this->db->from('Reserva_Detalles rd');
            $this->db->join('Vajilla v', 'rd.vajilla_id = v.vajilla_id', 'left');
            $this->db->join('Manteleria m', 'rd.manteleria_id = m.manteleria_id', 'left');
            $this->db->where('rd.reserva_id', $reserva_id);
            $detalles = $this->db->get()->result();

            return array(
                'reserva' => $reserva,
                'detalles' => $detalles
            );
        }

        return null;
    }

    public function obtener_reservas_por_fechas($fecha_inicio, $fecha_fin)
    {
        $this->db->select('r.*, 
                           u_aprobado.nombre AS aprobado_por_nombre, 
                           u_entregado.nombre AS entregado_por_nombre, 
                           u_recogido.nombre AS recogido_por_nombre,
                           u_cliente.nombre AS cliente_nombre, 
                           u_cliente.primerApellido AS cliente_primerApellido, 
                           u_cliente.segundoApellido AS cliente_segundoApellido');
        $this->db->from('Reservas r');
        $this->db->join('Usuarios u_aprobado', 'r.aprobado_por = u_aprobado.usuario_id', 'left');
        $this->db->join('Usuarios u_entregado', 'r.entregado_por = u_entregado.usuario_id', 'left');
        $this->db->join('Usuarios u_recogido', 'r.recogido_por = u_recogido.usuario_id', 'left');
        $this->db->join('Usuarios u_cliente', 'r.usuario_id = u_cliente.usuario_id', 'left'); // Unión para el cliente que hizo la reserva
        $this->db->where('r.fecha_reserva >=', $fecha_inicio);
        $this->db->where('r.fecha_reserva <=', $fecha_fin);
        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_reservas_usuario($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('Reservas');
        return $query->result(); // Devuelve un array de objetos con los datos de la reserva
    }
    public function obtener_reserva_por_id($reserva_id)
    {
        $this->db->where('reserva_id', $reserva_id);
        $query = $this->db->get('Reservas');
        return $query->row(); // Devuelve un solo objeto
    }
    public function obtener_detalles_por_reserva_id($reserva_id)
    {
        $this->db->select('Reserva_Detalles.*, Manteleria.nombre AS nombre_manteleria, Vajilla.nombre AS nombre_vajilla');
        $this->db->from('Reserva_Detalles');
        $this->db->join('Manteleria', 'Reserva_Detalles.manteleria_id = Manteleria.manteleria_id', 'left');
        $this->db->join('Vajilla', 'Reserva_Detalles.vajilla_id = Vajilla.vajilla_id', 'left');
        $this->db->where('Reserva_Detalles.reserva_id', $reserva_id);
        $query = $this->db->get();
        return $query->result(); // Devuelve un conjunto de objetos
    }

    public function obtener_detalles_reserva($reserva_id)
    {
        // Consulta principal para obtener detalles de la reserva
        $this->db->select('rd.*, 
            v.nombre as nombre_vajilla, v.tipo as tipo_vajilla,
            m.nombre as nombre_manteleria, m.tipo as tipo_manteleria,
            r.usuario_id'); // Incluimos usuario_id para verificación
        $this->db->from('Reserva_Detalles rd');
        $this->db->join('Reservas r', 'rd.reserva_id = r.reserva_id');
        $this->db->join('Vajilla v', 'rd.vajilla_id = v.vajilla_id', 'left');
        $this->db->join('Manteleria m', 'rd.manteleria_id = m.manteleria_id', 'left');
        $this->db->where('rd.reserva_id', $reserva_id);

        // Obtener garzones asignados si existen
        $garzones = $this->db->select('e.nombre, e.apellido_paterno')
            ->from('garzones_reservas gr')
            ->join('Empleados e', 'gr.empleado_id = e.empleado_id')
            ->where('gr.reserva_id', $reserva_id)
            ->get()
            ->result();

        $resultado = $this->db->get()->result();

        if (!empty($resultado)) {
            $resultado[0]->garzones = $garzones;
        }

        return $resultado;
    }
    public function restar_monto_total($reserva_id, $monto)
    {
        // Obtener el monto actual de la reserva
        $this->db->select('monto_total');
        $this->db->from('Reservas');
        $this->db->where('reserva_id', $reserva_id);
        $query = $this->db->get();
        $reserva = $query->row();

        if ($reserva) {
            // Restar el monto del monto_total
            $nuevo_monto_total = $reserva->monto_total - $monto;

            // Asegurarse de que el monto total no sea negativo
            if ($nuevo_monto_total < 0) {
                $nuevo_monto_total = 0;
            }

            // Actualizar el nuevo monto_total en la base de datos
            $this->db->set('monto_total', $nuevo_monto_total);
            $this->db->where('reserva_id', $reserva_id);
            return $this->db->update('Reservas');
        }

        return false;
    }
    public function calcular_monto_total($reserva_id, $garzones)
    {
        // Seleccionamos la suma de cantidad * precio de la tabla 'Reserva_Detalles'
        $this->db->select('SUM(cantidad * precio) AS monto_total');
        $this->db->from('Reserva_Detalles');
        $this->db->where('reserva_id', $reserva_id);

        // Ejecutamos la consulta
        $query = $this->db->get();

        // Obtenemos el monto total de los detalles de la reserva
        $monto_total = $query->row()->monto_total;

        // Si hay garzones, sumamos el costo adicional (cantidad de garzones * 150)
        if ($garzones > 0) {
            $costo_garzones = $garzones * 150;
            $monto_total += $costo_garzones; // Sumamos el costo de los garzones al monto total
        }

        // Devolvemos el monto total con el costo de los garzones sumado (si los hay)
        return $monto_total;
    }


    public function actualizar_monto_total($reserva_id, $monto_total)
    {
        $this->db->set('monto_total', $monto_total);
        $this->db->where('reserva_id', $reserva_id);
        return $this->db->update('Reservas');
    }

}