<?php
class Reserva_detalle_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function guardar_detalle($reserva_id, $vajilla_id, $decoracion_id, $cantidad, $precio)
    {
        $data = array(
            'reserva_id' => $reserva_id,
            'vajilla_id' => $vajilla_id,
            'decoracion_id' => $decoracion_id,
            'cantidad' => $cantidad,
            'precio' => $precio
        );

        $this->db->insert('Reserva_Detalles', $data);
    }

    public function get_detalles_by_reserva($reserva_id)
    {
        // Seleccionamos los detalles de la reserva junto con los nombres de vajilla y decoración
        $this->db->select('Reserva_Detalles.*, Vajilla.nombre AS vajilla_nombre, Decoraciones.nombre AS decoracion_nombre, Decoraciones.tipo AS tipo');
        $this->db->from('Reserva_Detalles');
        $this->db->join('Vajilla', 'Reserva_Detalles.vajilla_id = Vajilla.vajilla_id', 'left');  // Unión con la tabla Vajilla
        $this->db->join('Decoraciones', 'Reserva_Detalles.decoracion_id = Decoraciones.decoracion_id', 'left');  // Unión con la tabla Decoraciones
        $this->db->where('Reserva_Detalles.reserva_id', $reserva_id);  // Filtramos por el ID de la reserva

        $query = $this->db->get();

        return $query->result();  // Retornamos los resultados
    }


}
