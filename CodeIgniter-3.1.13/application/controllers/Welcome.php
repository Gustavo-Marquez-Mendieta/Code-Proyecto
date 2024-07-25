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
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function user()
	{
		$this->load->view('inicio');
	}

	public function adminn()
	{
		$this->load->view('admin');
	}

	public function registro()
	{
		$this->load->view('registrarse');
	}

	public function vajilla()
	{
		$this->check_session_and_load_view('vajilla');
	}

	public function manteleria()
	{
		$this->check_session_and_load_view('manteleria');
	}

	public function bebidas()
	{
		$this->check_session_and_load_view('bebidas');
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

	private function check_session_and_load_view($view)
	{
		if ($this->session->userdata('nombre')) {
			$data['nombre'] = $this->session->userdata('nombre');
			$this->load->view($view, $data);
		} else {
			redirect('Welcome/index');
		}
	}
}
