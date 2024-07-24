<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function inicio()
	{
		$this->load->view('inicio');
	}
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
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

            redirect('Welcome/inicio');
        } else {

            $data['error'] = 'Usuario o contraseña incorrecta';
            $this->load->view('login', $data);
        }
    }
}
