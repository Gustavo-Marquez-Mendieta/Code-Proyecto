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
		$this->load->model('Productos_model');
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
		$this->load->view('adminManteleria', $data);
	}


	public function adminBebidas()
	{
		$data['bebidas'] = $this->Bebida_model->get_all_bebidas();
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('adminBebidas', $data);
	}
	public function adminBebidass()
	{
		$data['bebidas'] = $this->Bebida_model->get_all_bebidas();
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('CrudBebidas', $data);
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

	// Controller: Welcome.php
	public function agregar_al_carrito($producto_id)
	{
		$this->load->model('Productos_model');
		$producto = $this->Productos_model->get_producto_by_id($producto_id);

		if (!$producto) {
			show_error('Producto no encontrado');
		}

		$this->load->library('session');
		$carrito = $this->session->userdata('carrito');

		if (!$carrito) {
			$carrito = array();
		}

		if (isset($carrito[$producto['decoracion_id']])) {
			// Incrementar la cantidad si el producto ya está en el carrito
			$carrito[$producto['decoracion_id']]['cantidad'] += 1;
		} else {
			// Agregar el producto al carrito con una cantidad de 1
			$producto['cantidad'] = 1;
			$carrito[$producto['decoracion_id']] = $producto;
		}

		$this->session->set_userdata('carrito', $carrito);

		redirect('Welcome/carrito');
	}


	public function carrito()
	{
		$this->load->library('session');
		$data['productos'] = $this->session->userdata('carrito');

		$this->load->view('carrito', $data);
	}



	public function eliminar_del_carrito($producto_id)
	{
		$this->load->model('Productos_model');
		$this->Productos_model->eliminar_del_carrito($producto_id);
		redirect('Welcome/carrito');
	}


	public function vaciar_carrito()
	{
		$this->load->model('Productos_model');
		$this->Productos_model->vaciar_carrito();
		redirect('Welcome/carrito'); // Redirige a la vista del carrito
	}


	public function manteleria()
	{
		$this->load->model('Decoracion_model');
		$this->session->set_userdata('cart', []);
		$data['productos'] = $this->Decoracion_model->get_all_decoraciones(); // Asegúrate de que esta función exista en tu modelo

		// Obtener el nombre del usuario desde la sesión
		$data['nombre'] = $this->session->userdata('nombre'); // Cambia 'nombre' por el nombre de la variable en tu sesión

		$this->load->view('manteleria', $data);
	}

	public function bebidas()
	{
		$this->load->model('Bebida_model');
		$data['productos'] = $this->Bebida_model->get_all_bebidas(); // Asegúrate de que esta función exista en tu modelo
		$this->session->set_userdata('cart', []);
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
		$usuario_id = $this->session->userdata('usuario_id');

		if ($usuario_id) {
			$this->load->model('Usuario_model');
			$data['usuario'] = $this->Usuario_model->get_usuario_by_id($usuario_id);

			if ($data['usuario']) {
				$this->load->view('informacionUsuario', $data);
			} else {
				redirect('Welcome/error');
			}
		} else {
			redirect('Welcome/index');
		}
	}

	public function actualizar()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$this->load->model('Usuario_model');
		$this->load->library('email');

		// Obtener la contraseña actual y nueva de la solicitud
		$contraseña_actual = $this->input->post('contraseña_actual');
		$nueva_contraseña = $this->input->post('nueva_contraseña');

		// Obtener los datos actuales del usuario
		$usuario = $this->Usuario_model->get_usuario_by_id($usuario_id);

		// Verificar si la contraseña actual ingresada es correcta
		if (password_verify($contraseña_actual, $usuario->password)) {
			// Si la contraseña es correcta, actualizar los datos del usuario
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'usuario' => $this->input->post('usuario'),
				'celular' => $this->input->post('celular')
			);

			// Si se ingresó una nueva contraseña, agregarla a los datos a actualizar
			if (!empty($nueva_contraseña)) {
				$data['password'] = password_hash($nueva_contraseña, PASSWORD_BCRYPT);

				// Configuración del correo
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
					'smtp_port' => 587,
					'smtp_user' => 'marquez.gustavo.1296@gmail.com',
					'smtp_pass' => 'mhjp nbfq xqhj hiys',
					'mailtype' => 'html',
					'charset' => 'utf-8',
					'wordwrap' => TRUE,
					'newline' => "\r\n",
					'smtp_crypto' => 'tls'
				);
				$this->email->initialize($config);

				// Enviar correo electrónico
				$this->email->from('tu_email@gmail.com', 'El Detalle Eventos');
				$this->email->to($usuario->usuario); // Suponiendo que el email del usuario es su nombre de usuario
				$this->email->subject('Cambio de Contraseña');
				$this->email->message('Tu contraseña ha sido cambiada exitosamente. La nueva contraseña es: ' . $nueva_contraseña);

				if ($this->email->send()) {
					$this->session->set_flashdata('success', 'Contraseña actualizada y notificación enviada a tu correo.');
				} else {
					$this->session->set_flashdata('error', 'Contraseña actualizada pero no se pudo enviar el correo: ' . $this->email->print_debugger());
				}
			}

			// Actualizar el usuario en la base de datos
			$this->Usuario_model->actualizar_usuario($usuario_id, $data);

			// Redirigir a la página de configuración
			redirect('Welcome/configuracion');
		} else {
			// Si la contraseña actual no es válida, mostrar un mensaje de error
			$this->session->set_flashdata('error', 'Contraseña actual no válida.');
			redirect('Welcome/configuracion');
		}
	}




	public function registrarusuariobd()
	{

		$password = bin2hex(random_bytes(8));

		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'usuario' => $this->input->post('usuario'),
			'password' => password_hash($password, PASSWORD_BCRYPT), // Almacena la contraseña cifrada
			'celular' => $this->input->post('celular'),
			'estado' => 0, // Estado de verificación pendiente
			'fechaCreacionUsuario' => date('Y-m-d H:i:s'),
			'fechaActualizacionUsuario' => null
		);


		if (empty($data['nombre']) || empty($data['usuario']) || empty($data['celular'])) {
			$data['error'] = 'Todos los campos son obligatorios';
			$this->load->view('registrarse', $data);
			return;
		}

		if ($this->login_model->existeUsuarioPorCorreo($data['usuario'])) {
			$data['error'] = 'El correo ya está registrado';
			$this->load->view('registrarse', $data);
			return;
		}

		$this->login_model->agregarusuario($data);


		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587, // El puerto 587 es compatible con STARTTLS
			'smtp_user' => 'marquez.gustavo.1296@gmail.com',
			'smtp_pass' => 'mhjp nbfq xqhj hiys', // Llave de correo electrónico
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE,
			'newline' => "\r\n", // IMPORTANTE: Necesario para SMTP
			'smtp_crypto' => 'tls' // Utiliza STARTTLS para la conexión segura
		);

		$this->load->library('email', $config);
		$this->email->from('tu_email@gmail.com', 'Gustavo Marquez');
		$this->email->to($data['usuario']);
		$this->email->subject('Tu Contraseña');
		$this->email->message('Tu cuenta ha sido creada. Tu contraseña es: ' . $password);

		if ($this->email->send()) {
			$data['success'] = 'Se envio su contraseña a' . $data['usuario'];
		} else {
			$data['error'] = 'Correo no enviado: ' . $this->email->print_debugger();
		}

		$this->load->view('welcome_message', $data);
	}

	public function editUser($usuario_id)
	{
		$this->load->model('Usuario_model');

		$data['usuario'] = $this->Usuario_model->getUserById($usuario_id);

		if (!$data['usuario']) {
			show_404();
		}

		$this->load->view('editarUsuario', $data);
	}

	// Método para actualizar el usuario
	public function updateUser()
	{
		$this->load->model('Usuario_model');

		$usuario_id = $this->input->post('usuario_id');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'usuario' => $this->input->post('usuario'),
			'celular' => $this->input->post('celular'),
			'estado' => $this->input->post('estado')
		);

		$result = $this->Usuario_model->updateUser($usuario_id, $data);

		if ($result) {
			$this->session->set_flashdata('success', 'Usuario actualizado correctamente');
		} else {
			$this->session->set_flashdata('error', 'Error al actualizar el usuario');
		}

		redirect('Welcome/adminUser');
	}

	public function validarusuariobd()
	{
		$user = $this->input->post('email');
		$password = $this->input->post('password');

		if ($this->login_model->validarusuario($user, $password)) {
			$usuario = $this->login_model->obtenerUsuarioPorEmail($user);
			$this->session->set_userdata('usuario_id', $usuario->usuario_id);
			$this->session->set_userdata('nombre', $usuario->nombre . ' ' . $usuario->primerApellido);

			if ($user === 'gustavo@gmail.com') {
				redirect('Welcome/admin');
			} else {
				redirect('Welcome/inicio');
			}
		} else {
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('welcome_message', $data);
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

			if ($this->Bebida_model->insert_bebida($data)) {
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
