<?php
class Reserva_detalle_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function guardar_detalle($reserva_id, $vajilla_id, $manteleria_id, $cantidad, $precio)
    {
        $data = array(
            'reserva_id' => $reserva_id,
            'vajilla_id' => $vajilla_id,
            'manteleria_id' => $manteleria_id,
            'cantidad' => $cantidad,
            'precio' => $precio
        );

        $this->db->insert('Reserva_Detalles', $data);
    }

    public function get_detalles_by_reserva($reserva_id)
    {

        $this->db->select('Reserva_Detalles.*, Vajilla.nombre AS vajilla_nombre, Manteleria.nombre AS manteleria_nombre, Manteleria.tipo AS tipo, Reservas.detalles AS detalles');
        $this->db->from('Reserva_Detalles');
        $this->db->join('Vajilla', 'Reserva_Detalles.vajilla_id = Vajilla.vajilla_id', 'left');
        $this->db->join('Reservas', 'Reserva_Detalles.reserva_id = Reservas.reserva_id', 'left');
        $this->db->join('Manteleria', 'Reserva_Detalles.manteleria_id = Manteleria.manteleria_id', 'left');
        $this->db->where('Reserva_Detalles.reserva_id', $reserva_id);

        $query = $this->db->get();

        return $query->result();
    }
    public function eliminar_detalle($detalle_id)
    {
        return $this->db->delete('Reserva_Detalles', ['detalle_id' => $detalle_id]);
    }


}
