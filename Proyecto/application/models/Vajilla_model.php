<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vajilla_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_all_products()
    {
        $query = $this->db->get('Vajilla');
        return $query->result();
    }
    public function get_all_vajilla()
    {
        $query = $this->db->get('Vajilla');
        return $query->result_array();
    }

    public function insert_vajilla($data)
    {
        return $this->db->insert('Vajilla', $data);
    }
    public function get_vajilla_by_id($id)
    {
        $query = $this->db->get_where('Vajilla', array('vajilla_id' => $id));
        return $query->row_array();
    }
    public function update_vajilla($id, $data)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->update('Vajilla', $data);
    }

    public function updateVajilla()
    {
        $id = $this->input->post('id');
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('imagen')) {
            $upload_data = $this->upload->data();
            $imagen = $upload_data['file_name'];
        } else {
            $imagen = $this->input->post('imagen');
        }

        $data = array(
            'nombre' => $this->input->post('nombre'),
            'tipo' => $this->input->post('tipo'),
            'precio' => $this->input->post('precio'),
            'imagen' => $imagen
        );

        $this->update_vajilla($id, $data);
        $this->session->set_flashdata('success', 'Producto actualizado correctamente.');
        redirect('Welcome/CrudVajilla');
    }
    public function delete_vajilla($id)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->delete('Vajilla');
    }
    public function get_product($id)
    {
        $this->db->where('vajilla_id', $id);
        $query = $this->db->get('Vajilla');
        return $query->row();
    }

    public function update_stock($id, $new_stock)
    {
        $this->db->where('vajilla_id', $id);
        $this->db->update('Vajilla', array('stock_cajas' => $new_stock));
    }
    public function devolver_stock($vajilla_id, $cantidad)
    {
        // Obtener el stock actual
        $this->db->set('stock_cajas', 'stock_cajas + ' . (int) $cantidad, FALSE);
        $this->db->where('vajilla_id', $vajilla_id);
        $this->db->update('Vajilla');
    }
    

}
