<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vajilla_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_vajilla()
    {
        $query = $this->db->get('Vajilla');
        return $query->result_array(); // Asegúrate de que devuelve un array asociativo
    }

    public function insert_vajilla($data)
    {
        return $this->db->insert('Vajilla', $data);
    }

    public function get_vajilla_by_id($id)
    {
        $query = $this->db->get_where('vajilla', array('vajilla_id' => $id));
        return $query->row_array(); // Devolver una fila como un array asociativo
    }
    public function update_vajilla($id, $data)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->update('Vajilla', $data);
    }

    public function updateVajilla()
    {
        $id = $this->input->post('id');

        // Configuración de la carga de imágenes
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // Tamaño máximo en KB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('imagen')) {
            // Imagen cargada exitosamente
            $upload_data = $this->upload->data();
            $imagen = $upload_data['file_name'];
        } else {
            // Mantener la imagen actual si no se subió una nueva
            $imagen = $this->input->post('imagen');
        }

        $data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'precio' => $this->input->post('precio'),
            'imagen' => $imagen
        );

        $this->Vajilla_model->update_vajilla($id, $data);
        $this->session->set_flashdata('success', 'Producto actualizado correctamente.');
        redirect('Welcome/CrudVajilla');
    }

    public function delete_vajilla($id)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->delete('Vajilla');
    }
}
