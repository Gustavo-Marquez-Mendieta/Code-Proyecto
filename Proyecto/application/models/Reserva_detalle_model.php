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
        $this->db->select('rd.cantidad, rd.precio, v.nombre as vajilla_nombre, v.tipo as vajilla_tipo, v.precio as vajilla_precio, d.nombre as decoracion_plan, d.tipo as decoracion_tipo, d.precio as decoracion_precio');
        $this->db->from('Reserva_Detalles rd');
        $this->db->join('Vajilla v', 'rd.vajilla_id = v.vajilla_id', 'left');
        $this->db->join('Decoraciones d', 'rd.decoracion_id = d.decoracion_id', 'left');
        $this->db->where('rd.reserva_id', $reserva_id);
        $query = $this->db->get();
        return $query->result();
    }
    
}
