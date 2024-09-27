<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrador extends CI_Controller
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
        $this->load->model('Reserva_detalle_model');
        $this->load->model('Reservas_model');
        $this->load->model('Empleado_model');
    }
  
}