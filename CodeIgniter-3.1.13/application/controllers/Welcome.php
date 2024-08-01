<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->library('session');
		$this->load->model('Usuario_model');
		$this->load->model('Vajilla_model');
		$this->load->model('Decoracion_model');
		$this->load->library('form_validation');
		$this->load->model('Bebida_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function user()
	{
		$this->load->view('inicio');
	}

	public function adminVajilla()
	{
		$this->check_session_and_load_view('adminVajilla');
	}

	public function CrudVajilla()
	{
		$this->load->model('Vajilla_model');

		// Obtener todos los datos de la vajilla
		$data['vajilla'] = $this->Vajilla_model->get_all_vajilla();

		// Cargar la vista y pasar los datos
		$this->load->view('CrudVajilla', $data);
	}

	public function adminManteleria()
	{
		$data['decoraciones'] = $this->Decoracion_model->get_all_decoraciones();

		if (empty($data['decoraciones'])) {
			$data['error'] = 'No se encontraron decoraciones.';
		}

		$this->load->view('manteleria', $data);
	}


	public function adminBebidas()
	{
		$data['bebidas'] = $this->Bebida_model->get_all_bebidas();
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('adminBebidas', $data);
	}

	public function adminUser()
	{
		$this->check_session_and_load_view('adminUser', true);
	}

	public function registro()
	{
		$this->load->view('registrarse');
	}

	public function vajilla()
	{
		$this->load->model('Vajilla_model');
		$data['productos'] = $this->Vajilla_model->get_all_products(); // Asegúrate de que esta función exista en tu modelo

		// Obtener el nombre del usuario desde la sesión
		$data['nombre'] = $this->session->userdata('nombre'); // Cambia 'nombre' por el nombre de la variable en tu sesión

		$this->load->view('vajilla', $data);
	}



	public function manteleria()
	{
		$this->load->model('Decoracion_model');
		$data['productos'] = $this->Decoracion_model->get_all_decoraciones(); // Asegúrate de que esta función exista en tu modelo

		// Obtener el nombre del usuario desde la sesión
		$data['nombre'] = $this->session->userdata('nombre'); // Cambia 'nombre' por el nombre de la variable en tu sesión

		$this->load->view('manteleria', $data);
	}

	public function bebidas()
	{
		$this->load->model('Bebida_model');
		$data['productos'] = $this->Bebida_model->get_all_bebidas(); // Asegúrate de que esta función exista en tu modelo

		// Obtener el nombre del usuario desde la sesión
		$data['nombre'] = $this->session->userdata('nombre'); // Cambia 'nombre' por el nombre de la variable en tu sesión

		$this->load->view('bebidas', $data);
	}

	public function informacionUsuario()
	{
		$this->check_session_and_load_view('informacionUsuario');
	}

	public function configuracion()
	{
		$this->check_session_and_load_view('configuracion');
	}

	public function registrarusuariobd()
	{
		$data = array(
			'nombre' => $this->input->post('nombre_completo'),
			'usuario' => $this->input->post('usuario'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'celular' => $this->input->post('numero_celular')
		);

		if (empty($data['nombre']) || empty($data['usuario']) || empty($data['password']) || empty($data['celular'])) {
			$data['error'] = 'Todos los campos son obligatorios';
			$this->load->view('registrarse', $data);
			return;
		}

		if ($this->login_model->existeUsuarioPorNombre($data['nombre'])) {
			$data['error'] = 'El nombre de nombre ya está registrado';
			$this->load->view('registrarse', $data);
			return;
		}

		if ($this->login_model->existeUsuarioPorCorreo($data['usuario'])) {
			$data['error'] = 'El correo usuario ya está registrado';
			$this->load->view('registrarse', $data);
			return;
		}

		if ($this->login_model->existeUsuarioPorCelular($data['celular'])) {
			$data['error'] = 'El número de celular ya está registrado';
			$this->load->view('registrarse', $data);
			return;
		}

		if ($this->login_model->agregarusuario($data)) {
			$data['success'] = 'Usuario registrado correctamente';
			$this->load->view('welcome_message', $data);
		} else {
			$data['error'] = 'Error al registrar el usuario';
			$this->load->view('registrarse', $data);
		}
	}

	public function validarusuariobd()
	{
		$user = $this->input->post('email');
		$password = $this->input->post('password');

		if ($this->login_model->validarusuario($user, $password)) {
			$nombre_completo = $this->login_model->obtenerNombreCompleto($user);
			$this->session->set_userdata('nombre', $nombre_completo);

			if ($user === 'Gustavo@gmail.com') {
				redirect('Welcome/admin');
			} else {
				redirect('Welcome/inicio');
			}
		} else {
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('index', $data);
		}
	}

	public function admin()
	{
		$this->check_session_and_load_view('admin');
	}

	public function inicio()
	{
		$this->check_session_and_load_view('inicio');
	}

	public function cerrarsesion()
	{
		$this->session->sess_destroy();
		redirect('Welcome/index');
	}

	private function check_session_and_load_view($view, $load_users = false)
	{
		if ($this->session->userdata('nombre')) {
			$data['nombre'] = $this->session->userdata('nombre');

			if ($load_users) {
				$data['usuarios'] = $this->Usuario_model->get_usuarios();
			}

			$this->load->view($view, $data);
		} else {
			redirect('Welcome/index');
		}
	}

	public function eliminarUsuario($usuario_id)
	{
		if ($this->Usuario_model->eliminar_usuario($usuario_id)) {
			$this->session->set_flashdata('success', 'Usuario eliminado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al eliminar el usuario.');
		}
		redirect('Welcome/adminUser');
	}

	public function agregarVajilla()
	{
		// Configuración de la carga de imágenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048; // Tamaño máximo en KB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen')) {
			// Error al cargar la imagen
			$data['error'] = $this->upload->display_errors();
			$this->load->view('adminVajilla', $data);
			return;
		} else {
			// Imagen cargada exitosamente
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		}

		// Recoger datos del formulario
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'tipo' => $this->input->post('tipo'),
			'precio' => $this->input->post('precio'),
			'imagen' => $imagen
		);

		// Guardar en la base de datos
		if ($this->Vajilla_model->insert_vajilla($data)) {
			$this->session->set_flashdata('success', 'Producto agregado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al agregar el producto.');
		}

		redirect('Welcome/adminVajilla');
	}

	public function editVajilla($id)
	{
		$data['vajilla'] = $this->Vajilla_model->get_vajilla_by_id($id);

		if (empty($data['vajilla'])) {
			show_404(); // Muestra un error 404 si no se encuentra el producto
		}

		$this->load->view('editVajilla', $data);
	}
	public function updateVajilla()
	{
		$id = $this->input->post('vajilla_id'); // Asegúrate de que este nombre coincida con el nombre en tu formulario

		// Configuración de la carga de imágenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048; // Tamaño máximo en KB

		$this->load->library('upload', $config);

		// Obtener la imagen actual
		$imagen_actual = $this->input->post('imagen');

		// Verificar si se ha subido una nueva imagen
		if ($this->upload->do_upload('imagen')) {
			// Imagen cargada exitosamente
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		} else {
			// Mantener la imagen actual si no se subió una nueva
			$imagen = $imagen_actual;
		}

		// Recoger datos del formulario
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'tipo' => $this->input->post('tipo'),
			'precio' => $this->input->post('precio'),
			'imagen' => $imagen // Usar la imagen actualizada o la existente
		);

		// Llamar al método del modelo para actualizar la vajilla
		if ($this->Vajilla_model->update_vajilla($id, $data)) {
			$this->session->set_flashdata('success', 'Producto actualizado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al actualizar el producto.');
		}

		redirect('Welcome/CrudVajilla');
	}



	public function deleteVajilla($id)
	{
		$this->Vajilla_model->delete_vajilla($id);
		redirect('Welcome/CrudVajilla');
	}
	public function agregarDecoracion()
	{
		// Configuración de la carga de imágenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048; // Tamaño máximo en KB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen')) {
			// Error al cargar la imagen
			$data['error'] = $this->upload->display_errors();
			$this->load->view('admin', $data); // Asegúrate de cargar la vista correcta
			return;
		} else {
			// Imagen cargada exitosamente
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		}

		// Recoger datos del formulario
		$data = array(
			'tipo' => $this->input->post('tipo'),
			'precio' => $this->input->post('precio'),
			'plan' => $this->input->post('plan'),
			'imagen' => $imagen
		);

		// Guardar en la base de datos
		if ($this->Decoracion_model->insert_decoracion($data)) {
			$this->session->set_flashdata('success', 'Decoración agregada correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al agregar la decoración.');
		}

		redirect('Welcome/adminManteleria'); // Asegúrate de redirigir al lugar adecuado
	}
	public function adminDecoraciones()
	{
		$data['nombre'] = $this->session->userdata('nombre'); // Obtener el nombre del usuario de la sesión
		$data['decoraciones'] = $this->Decoracion_model->get_all_decoraciones(); // Obtener todas las decoraciones

		$this->load->view('CrudDecoracion', $data); // Cargar la vista con los datos
	}
	public function editarDecoracion($id)
	{
		// Validar si el formulario ha sido enviado
		if ($this->input->post()) {
			// Configuración de subida de archivo
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] = $_FILES['imagen']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('imagen')) {
				$upload_data = $this->upload->data();
				$imagen = $upload_data['file_name'];
			} else {
				$imagen = $this->input->post('imagen_actual'); // Mantener la imagen actual si no se subió una nueva
			}

			// Actualizar decoración
			$data = array(
				'tipo' => $this->input->post('tipo'),
				'precio' => $this->input->post('precio'),
				'plan' => $this->input->post('plan'),
				'imagen' => $imagen
			);

			if ($this->Decoracion_model->update_decoracion($id, $data)) {
				// Redirigir o mostrar un mensaje de éxito
				redirect('Welcome/adminDecoraciones');
			} else {
				// Mostrar mensaje de error
				echo 'Error al actualizar la decoración.';
			}
		} else {
			// Cargar datos de la decoración y mostrar el formulario
			$data['decoracion'] = $this->Decoracion_model->get_decoracion_by_id($id);
			$this->load->view('EditarDecoracion', $data);
		}
	}


	public function deleteDecoracion($id)
	{
		$this->Decoracion_model->delete_decoracion($id); // Eliminar decoración por ID
		redirect('Welcome/adminDecoraciones'); // Redirigir a la lista de decoraciones
	}

	public function agregarBebida()
	{
		if ($this->input->post()) {
			// Configuración de subida de archivo
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] = $_FILES['imagen']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('imagen')) {
				$upload_data = $this->upload->data();
				$imagen = $upload_data['file_name'];
			} else {
				$imagen = null; // Mantener como null si no se subió una imagen
			}

			// Preparar datos para insertar
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'ingredientes' => $this->input->post('ingredientes'),
				'imagen' => $imagen
			);

			if ($this->Bebida_model->insertar_bebida($data)) {
				// Redirigir o mostrar un mensaje de éxito
				redirect('Welcome/adminBebidas');
			} else {
				// Mostrar mensaje de error
				$data['error'] = 'Error al agregar la bebida.';
				$this->load->view('agregar_bebida', $data);
			}
		} else {
			// Mostrar formulario de agregar bebida
			$this->load->view('agregar_bebida');
		}
	}
	public function editarBebida($id)
	{
		$data['bebida'] = $this->Bebida_model->get_bebida_by_id($id);
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('editar_bebida', $data);
	}
	public function actualizarBebida($id)
	{
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('imagen')) {
			$file_data = $this->upload->data();
			$imagen = $file_data['file_name'];
		} else {
			$bebida = $this->Bebida_model->get_bebida_by_id($id);
			$imagen = $bebida['imagen'];
		}

		$data = array(
			'nombre' => $this->input->post('nombre'),
			'ingredientes' => $this->input->post('ingredientes'),
			'imagen' => $imagen
		);

		$this->Bebida_model->update_bebida($id, $data);
		redirect('Welcome/adminBebidass');
	}
	public function deleteBebida($id)
	{
		$this->Bebida_model->delete_bebida($id);
		redirect('Welcome/adminBebidas');
	}
}
