<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vajilla_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Obtiene todos los elementos de la tabla Vajilla.
     *
     * @return array Un array asociativo de elementos de vajilla.
     */
    public function get_all_products() {
        $query = $this->db->get('Vajilla');
        return $query->result();
    }

    /**
     * Inserta un nuevo elemento en la tabla Vajilla.
     *
     * @param array $data Los datos del nuevo elemento.
     * @return bool TRUE si se insertó correctamente, FALSE en caso contrario.
     */
    public function insert_vajilla($data)
    {
        return $this->db->insert('Vajilla', $data);
    }

    /**
     * Obtiene un elemento específico de la tabla Vajilla por su ID.
     *
     * @param int $id El ID del elemento.
     * @return array Un array asociativo con los datos del elemento.
     */
    public function get_vajilla_by_id($id)
    {
        $query = $this->db->get_where('Vajilla', array('vajilla_id' => $id));
        return $query->row_array(); // Devuelve una fila como un array asociativo
    }

    /**
     * Actualiza un elemento existente en la tabla Vajilla.
     *
     * @param int $id El ID del elemento a actualizar.
     * @param array $data Los nuevos datos del elemento.
     * @return bool TRUE si se actualizó correctamente, FALSE en caso contrario.
     */
    public function update_vajilla($id, $data)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->update('Vajilla', $data);
    }

    /**
     * Actualiza un elemento existente en la tabla Vajilla y maneja la carga de imágenes.
     *
     * @return void
     */
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
            'tipo' => $this->input->post('tipo'),
            'precio' => $this->input->post('precio'),
            'imagen' => $imagen
        );

        $this->update_vajilla($id, $data);
        $this->session->set_flashdata('success', 'Producto actualizado correctamente.');
        redirect('Welcome/CrudVajilla');
    }

    /**
     * Elimina un elemento de la tabla Vajilla por su ID.
     *
     * @param int $id El ID del elemento a eliminar.
     * @return bool TRUE si se eliminó correctamente, FALSE en caso contrario.
     */
    public function delete_vajilla($id)
    {
        $this->db->where('vajilla_id', $id);
        return $this->db->delete('Vajilla');
    }
}
