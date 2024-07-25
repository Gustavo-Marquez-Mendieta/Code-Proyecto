<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function user()
	{
		$this->load->view('inicio');
	}
	public function adminn()
	{
		$this->load->view('admin');
	}
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function registro()
	{
		$this->load->view('registrarse');
	}
	public function registrarusuariobd()
	{
		$data['nombre'] = $this->input->post('nombre_completo');
		$data['usuario'] = $this->input->post('usuario');
		$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		$data['celular'] = $this->input->post('numero_celular');

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
		$user = $_POST['email'];
		$password = $_POST['password'];

		if ($this->login_model->validarusuario($user, $password)) {
			// Recuperar el nombre completo del usuario desde la base de datos
			$nombre_completo = $this->login_model->obtenerNombreCompleto($user);

			// Configurar la sesión
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
		// Verifica si la sesión está activa
		if ($this->session->userdata('nombre')) {
			$data['nombre'] = $this->session->userdata('nombre');
			$this->load->view('admin', $data);
		} else {
			redirect('welcome?message'); // Redirige al inicio de sesión si no hay sesión activa
		}
	}
	public function inicio() {
        if ($this->session->userdata('nombre')) {
            $data['nombre'] = $this->session->userdata('nombre');
            $this->load->view('inicio', $data);
        } else {
            redirect('welcome_message');
        }
    }
	public function cerrarsesion()
	{
		// Destruir la sesión
		$this->session->sess_destroy();
		// Redirigir a la página de inicio de sesión
		redirect('Welcome/index'); // Ajusta la ruta según tu configuración
	}
}
