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
		$this->load->model('Reserva_detalle_model');
		$this->load->model('Reservas_model');
		$this->load->model('Empleado_model');
		$this->load->model('Manteleria_model');
		$this->load->model('Bebida_model');
	}

	public function index()
	{
		$this->session->unset_userdata('email_verificado');
		$this->session->unset_userdata('email_temporal');
		$this->session->unset_userdata('codigo_verificacion');
		$this->load->view('welcome_message');
	}
	public function user()
	{
		$this->check_session_and_load_view('inicio');
	}
	private function check_session_and_load_view($view, $data = [], $load_users = false)
	{
		if ($this->session->userdata('nombre')) {
			$data['nombre'] = $this->session->userdata('nombre');

			if ($load_users) {
				$this->load->model('Usuario_model');
				$data['usuarios'] = $this->Usuario_model->get_usuarios();
			}
			$this->load->view($view, $data);
		} else {
			redirect('Welcome/index');
		}
	}


	public function mis_reservas()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$nombre = $this->session->userdata('nombre');
		$this->load->model('Reservas_model');
		$data['reservas'] = $this->Reservas_model->obtener_reservas_usuario($usuario_id);
		$data['usuario_id'] = $usuario_id;
		$this->check_session_and_load_view('reservas', $data);
	}
	public function detalle_evento($reserva_id)
	{
		$this->load->model('Reservas_model');
		$data['reserva'] = $this->Reservas_model->obtener_reserva_por_id($reserva_id);
		$data['detalles'] = $this->Reservas_model->obtener_detalles_por_reserva_id($reserva_id);

		if (!$data['reserva']) {
			show_404();
		}

		$this->check_session_and_load_view('detalle_evento', $data);
	}



	public function adminVajilla()
	{
		$this->check_session_and_load_view('administrador/adminVajilla');
	}

	public function CrudVajilla()
	{
		$this->load->model('Vajilla_model');
		$data['vajilla'] = $this->Vajilla_model->get_all_vajilla();
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/CrudVajilla', $data);
	}
	public function adminDecoracion()
	{
		$data['decoraciones'] = $this->Decoracion_model->get_all_decoraciones();
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/adminDecoracion', $data);
	}
	public function adminManteleria()
	{
		$data['decoraciones'] = $this->Manteleria_model->get_all_manteleria();
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/adminManteleria', $data);
	}
	public function solicitudes()
	{
		$this->load->model('Reservas_model');
		$data['reservas'] = $this->Reservas_model->get_all_reservas();
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/solicitudes', $data);
	}
	public function reportes()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/reportes', $data);
	}
	public function tipo_evento()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/tipo_evento', $data);
	}
	public function reporte_empleado()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$data['empleados'] = $this->Reservas_model->obtener_empleados();


		if ($this->input->post()) {
			$empleado_id = $this->input->post('empleado');
			$fecha_inicio = $this->input->post('fecha_inicio');
			$fecha_fin = $this->input->post('fecha_fin');

			$data['eventos'] = $this->Reservas_model->obtener_eventos_empleado($empleado_id, $fecha_inicio, $fecha_fin);

			$data['empleado'] = $this->Reservas_model->obtener_empleado_por_id($empleado_id);
		} else {
			$data['eventos'] = null;
			$data['empleado'] = null;
		}

		$this->load->view('administrador/reporte_empleado', $data);
	}
	public function reporte_barras()
	{
		$this->load->model('Reservas_model');
		$data['eventos_por_mes'] = $this->Reservas_model->getEventosPorMes();
		$this->load->view('administrador/reporte_diagrama_eventos', $data);
	}
	public function ingredientes_bebida($bebida_id)
	{
		$this->load->model('Bebida_model');
		$data['bebida'] = $this->Bebida_model->get_bebida($bebida_id);
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('ingredientes', $data);
	}

	public function reporte_evento()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		// Comprobar si se ha enviado un formulario
		if ($this->input->post()) {
			// Si el formulario fue enviado, obtener los datos
			$tipo_evento = $this->input->post('evento');
			$fecha_inicio = $this->input->post('fecha_inicio');
			$fecha_fin = $this->input->post('fecha_fin');

			// Obtener los eventos del tipo seleccionado en el rango de fechas
			$data['eventos'] = $this->Reservas_model->obtener_eventos_por_tipo($tipo_evento, $fecha_inicio, $fecha_fin);
		} else {
			$data['eventos'] = null;
		}

		// Cargar la vista del reporte con los datos
		$this->load->view('administrador/tipo_evento', $data);
	}
	public function obtener_detalles_reservas($reserva_id)
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
			return;
		}

		$this->load->model('Reservas_model');
		$resultado = $this->Reservas_model->obtener_detalles_tipo($reserva_id);

		if ($resultado) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($resultado));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_status_header(404)
				->set_output(json_encode(['error' => 'Reserva no encontrada']));
		}
	}
	public function reporte_fechas()
	{
		$data['nombre'] = $this->session->userdata('nombre');

		// Comprobar si se ha enviado un formulario
		if ($this->input->post()) {
			// Si el formulario fue enviado, obtener los datos
			$fecha_inicio = $this->input->post('fecha_inicio');
			$fecha_fin = $this->input->post('fecha_fin');

			// Obtener todas las reservas en el rango de fechas
			$data['reservas'] = $this->Reservas_model->obtener_reservas_por_fechas($fecha_inicio, $fecha_fin);
		} else {
			$data['reservas'] = null;
		}

		// Cargar la vista del reporte con los datos
		$this->load->view('administrador/reportes', $data);
	}

	public function filtrarSolicitudes()
	{
		$estado = $this->input->post('estado');

		$this->load->model('Reservas_model');
		$reservas = $this->Reservas_model->get_reservas_by_estado($estado);


		if (!empty($reservas)) {
			foreach ($reservas as $reserva) {
				echo '
					<tr>
						<td>' . $reserva->usuario_id . '</td>
						<td>' . $reserva->fecha_reserva . '</td>
						<td>' . $reserva->tipo_evento . '</td>
						<td>' . $reserva->dias . '</td>
						<td>' . $reserva->monto_total . '</td>
						<td>' . $reserva->estado_pago . '</td>
						<td>
							<a href="' . site_url('Welcome/detalles/' . $reserva->reserva_id) . '" class="btn btn-danger" style="color:white">Detalles</a>
						</td>
					</tr>
				';
			}
		} else {
			echo '
				<tr>
					<td colspan="7">No hay reservas disponibles para este estado</td>
				</tr>
			';
		}
	}




	public function aprobar_solicitud($reserva_id)
	{
		$this->load->model('Reservas_model');
		$this->load->model('Reserva_detalle_model');
		$this->load->library('email');

		// Obtener el ID del usuario logueado
		$usuario_id = $this->session->userdata('usuario_id'); // Asegúrate de tener el ID del usuario en la sesión

		// Cambia el estado de la reserva y actualiza el usuario que aprobó
		$this->Reservas_model->update_estado_reserva($reserva_id, 'aprobado-esperando adelanto', $usuario_id);

		// Obtener los detalles de la reserva y el correo electrónico del usuario
		$reserva = $this->Reservas_model->get_reserva_con_usuario_by_id($reserva_id);
		$detalles = $this->Reserva_detalle_model->get_detalles_by_reserva($reserva_id);

		if ($reserva) {
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

			$this->email->from('tu_email@gmail.com', 'El Detalle Eventos');
			$this->email->to($reserva->email);
			$this->email->subject('Aprobación de Solicitud');

			// Construir el mensaje con detalles
			$mensaje = "<p>Tu solicitud ha sido aprobada. Por favor, procede con el adelanto.</p>";
			$mensaje .= "<p><strong>Detalles de la Reserva:</strong></p>";
			$mensaje .= "<p>Tipo de Evento: " . $reserva->tipo_evento . "</p>";
			$mensaje .= "<p>Monto Total: Bs. " . number_format($reserva->monto_total, 2) . "</p>";

			// Agregar detalles de los ítems en la reserva
			$mensaje .= "<p><strong>Detalles de los Ítems:</strong></p>";
			$mensaje .= "<table border='1' cellpadding='10'>";
			$mensaje .= "<thead><tr><th>Nombre</th><th>Tipo</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead>";
			$mensaje .= "<tbody>";

			foreach ($detalles as $detalle) {
				if (isset($detalle->vajilla_nombre)) {
					$nombre = $detalle->vajilla_nombre;
					$tipo = isset($detalle->vajilla_tipo) ? $detalle->vajilla_tipo : 'N/A'; // Avoid undefined error
					$precio = isset($detalle->vajilla_precio) ? $detalle->vajilla_precio : 0; // Default to 0 if not available
				} elseif (isset($detalle->manteleria_plan)) {
					$nombre = $detalle->manteleria_plan;
					$tipo = isset($detalle->manteleria_tipo) ? $detalle->manteleria_tipo : 'N/A';
					$precio = isset($detalle->manteleria_precio) ? $detalle->manteleria_precio : 0;
				} else {
					$nombre = 'Desconocido';
					$tipo = 'Desconocido';
					$precio = 0;
				}


				$total = $precio * $detalle->cantidad;
				$mensaje .= "<tr>";
				$mensaje .= "<td>$nombre</td>";
				$mensaje .= "<td>$tipo</td>";
				$mensaje .= "<td>Bs. " . number_format($precio, 2) . "</td>";
				$mensaje .= "<td>" . $detalle->cantidad . "</td>";
				$mensaje .= "<td>Bs. " . number_format($total, 2) . "</td>";
				$mensaje .= "</tr>";
			}

			$mensaje .= "</tbody></table>";

			$this->email->message($mensaje);

			if ($this->email->send()) {
				$this->session->set_flashdata('success', 'Solicitud aprobada y notificación enviada al correo.');
			} else {
				$this->session->set_flashdata('error', 'Solicitud aprobada pero no se pudo enviar el correo: ' . $this->email->print_debugger());
			}
		} else {
			$this->session->set_flashdata('error', 'No se pudo encontrar la reserva.');
		}

		redirect('Welcome/solicitudes');
	}
	public function cancelar_solicitud($reserva_id)
	{
		$this->load->model('Reservas_model');
		$this->load->model('Reserva_detalle_model');
		$this->load->library('email');

		// Obtener el ID del usuario logueado
		$usuario_id = $this->session->userdata('usuario_id');

		// Cambiar el estado de la reserva a "cancelado" y actualizar el usuario que realizó la acción
		$this->Reservas_model->update_estado_reserva($reserva_id, 'Cancelado', $usuario_id);

		// Obtener los detalles de la reserva y el correo electrónico del usuario
		$reserva = $this->Reservas_model->get_reserva_con_usuario_by_id($reserva_id);

		if ($reserva) {
			// Configuración del correo electrónico
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

			$this->email->from('tu_email@gmail.com', 'El Detalle Eventos');
			$this->email->to($reserva->email);
			$this->email->subject('Cancelación de Solicitud');

			// Construir el mensaje de cancelación
			$mensaje = "<p>Lamentamos informarte que tu solicitud no ha sido aceptada.</p>";
			$mensaje .= "<p>No se pudo aceptar tu solicitud. Si tienes preguntas, por favor contáctanos.</p>";

			$this->email->message($mensaje);

			if ($this->email->send()) {
				$this->session->set_flashdata('success', 'Solicitud cancelada y notificación enviada al correo.');
			} else {
				$this->session->set_flashdata('error', 'Solicitud cancelada pero no se pudo enviar el correo: ' . $this->email->print_debugger());
			}
		} else {
			$this->session->set_flashdata('error', 'No se pudo encontrar la reserva.');
		}

		redirect('Welcome/solicitudes');
	}

	public function recibir_adelanto($reserva_id)
	{
		$this->Reservas_model->update_estado_reserva($reserva_id, 'En Curso de entrega', $this->session->userdata('usuario_id'));
		redirect('Welcome/solicitudes');
	}


	public function entregar_vajilla($reserva_id)
	{
		$nuevo_estado = 'Vajilla Entregada';
		$this->Reservas_model->update_estado_entrega_vajilla($reserva_id, $nuevo_estado, $this->session->userdata('usuario_id'));
		redirect('Welcome/solicitudes');
	}


	public function recoger_vajilla($reserva_id)
	{
		$nuevo_estado = 'Vajilla Recogida';

		// Actualizar el estado de la reserva
		$this->Reservas_model->update_estado_recogida_vajilla($reserva_id, $nuevo_estado, $this->session->userdata('usuario_id'));

		// Obtener los detalles de la reserva
		$detalles = $this->Reservas_model->get_detalles_reserva($reserva_id);

		echo "<pre>";
		print_r($detalles);
		echo "</pre>";

		foreach ($detalles as $detalle) {
			// Verificar si tiene vajilla asignada
			if (!empty($detalle->vajilla_id)) {
				echo "Actualizando stock de vajilla ID: " . $detalle->vajilla_id . " Cantidad: " . $detalle->cantidad . "<br>";

				// Sumar la cantidad al stock de la Vajilla
				$this->db->set('stock_cajas', 'stock_cajas + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('vajilla_id', $detalle->vajilla_id);
				$this->db->update('Vajilla');
			}

			// Verificar si tiene mantelería asignada
			if (!empty($detalle->manteleria_id)) {
				echo "Actualizando stock de mantelería ID: " . $detalle->manteleria_id . " Cantidad: " . $detalle->cantidad . "<br>";

				// Sumar la cantidad al stock de la Mantelería
				$this->db->set('stock', 'stock + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('manteleria_id', $detalle->manteleria_id);
				$this->db->update('Manteleria');
			}
		}

		// Detener ejecución para revisar salida
		die();

		// Redirigir a la página de solicitudes
		redirect('Welcome/solicitudes');
	}


	public function guardar_detalles_recogida($reserva_id)
	{
		$detalles_recogida = $this->input->post('detalles');
		$nuevo_estado = 'Vajilla Recogida';

		$this->Reservas_model->update_estado_recogida_vajilla($reserva_id, $nuevo_estado, $detalles_recogida, $this->session->userdata('usuario_id'));

		$detalles = $this->Reservas_model->get_detalles_reserva($reserva_id);
		foreach ($detalles as $detalle) {

			if (!empty($detalle->vajilla_id)) {

				$this->db->set('stock_cajas', 'stock_cajas + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('vajilla_id', $detalle->vajilla_id);
				$this->db->update('Vajilla');
			}
			if (!empty($detalle->manteleria_id)) {

				$this->db->set('stock', 'stock + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('manteleria_id', $detalle->manteleria_id);
				$this->db->update('Manteleria');
			}
		}

		redirect('Welcome/solicitudes');
	}

	public function terminar_evento($reserva_id)
	{
		$this->Reservas_model->update_estado_reserva($reserva_id, 'Evento Completado', $this->session->userdata('usuario_id'));
		redirect('Welcome/solicitudes');
	}
	public function guardarGarzones()
	{
		$empleados = $this->input->post('empleados');

		if (!empty($empleados)) {
			$this->load->model('Garzones_model');

			foreach ($empleados as $empleado) {
				$this->Garzones_model->insertarGarzonReserva($empleado['reserva_id'], $empleado['empleado_id']);
			}
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
		}
	}
	public function agregar_garzones_evento()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$reserva_id = $data['reserva_id'];
		$garzones = $data['garzones'];

		$this->load->model('Garzones_reservas_model');
		$success = true;
		$exists = false;

		foreach ($garzones as $empleado_id) {
			// Verificar si el garzón ya está asignado a esta reserva
			if ($this->Garzones_reservas_model->garzon_existe_en_reserva($reserva_id, $empleado_id)) {
				$exists = true;
				continue;  // Si ya existe, saltamos la inserción para este garzón
			}

			// Insertar garzón en la tabla Garzones_Reservas
			$result = $this->Garzones_reservas_model->insert_garzon_reserva($reserva_id, $empleado_id);
			if (!$result) {
				$success = false;
				break;
			}
		}

		// Enviar respuesta JSON
		echo json_encode(['success' => $success, 'exists' => $exists]);
	}
	public function quitar_garzon()
	{
		$empleado_id = $this->input->post('empleado_id');
		$reserva_id = $this->input->post('reserva_id');


		$this->load->model('Garzones_reservas_model');


		if ($this->Garzones_reservas_model->eliminar_garzon_reserva($empleado_id, $reserva_id)) {

			echo json_encode(['status' => 'success', 'message' => 'Garzón eliminado correctamente.']);
		} else {

			echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el garzón.']);
		}
	}






	public function adminBebidas()
	{
		$data['bebidas'] = $this->Bebida_model->get_all_bebidas();
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('administrador/adminBebidas', $data);
	}
	public function adminBebidass()
	{
		$data['bebidas'] = $this->Bebida_model->get_all_bebidas();
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('administrador/CrudBebidas', $data);
	}

	public function adminUser()
	{
		$this->check_session_and_load_view('administrador/adminUser', true);
	}

	public function registro()
	{
		$this->session->unset_userdata('email_verificado');
		$this->session->unset_userdata('email_temporal');
		$this->session->unset_userdata('codigo_verificacion');

		// Cargar la vista de verificación de email
		$this->load->view('verificar_email');
	}
	public function registro_form()
	{
		// Verificar si el email está verificado
		if (!$this->session->userdata('email_verificado')) {
			redirect('Welcome/registro');
			return;
		}

		// Cargar la vista del formulario de registro
		$this->load->view('registrarse');
	}

	public function vajilla()
	{
		$this->load->model('Vajilla_model');
		$data['productos'] = $this->Vajilla_model->get_all_products(); // Asegúrate de que esta función exista en tu modelo
		$data['nombre'] = $this->session->userdata('nombre'); // Cambia 'nombre' por el nombre de la variable en tu sesión

		$this->load->view('vajilla', $data);
	}

	public function agregar_al_carrito($tipo_producto, $producto_id, $cantidad = 1)
	{
		$producto = null;
		switch ($tipo_producto) {
			case 'manteleria':
				$producto = $this->Productos_model->get_manteleria_by_id($producto_id);
				break;
			case 'vajilla':
				$producto = $this->Productos_model->get_vajilla_by_id($producto_id);
				break;
			default:
				show_error('Tipo de producto no válido');
				return;
		}

		if (!$producto) {
			show_error('Producto no encontrado');
		}

		if ($tipo_producto == 'manteleria') {
			if ($producto['stock'] < $cantidad) {
				$this->session->set_flashdata('error', 'No hay suficiente stock disponible.');
				redirect('Welcome/manteleria');
				return;
			}
			$nuevo_stock = $producto['stock'] - $cantidad;
			$this->Manteleria_model->update_stock_manteleria($producto_id, $nuevo_stock);
		} elseif ($tipo_producto == 'vajilla') {
			if ($producto['stock_cajas'] < $cantidad) {
				$this->session->set_flashdata('error', 'No hay suficiente stock disponible.');
				redirect('Welcome/vajilla');
				return;
			}
			$nuevo_stock = $producto['stock_cajas'] - $cantidad;
			$this->Productos_model->update_stock_vajilla($producto_id, $nuevo_stock);
		}

		$carrito = $this->session->userdata('carrito') ?: array();
		$producto_key = $tipo_producto . '_' . $producto_id;

		if (isset($carrito[$producto_key])) {
			$carrito[$producto_key]['cantidad'] += $cantidad;
		} else {
			$producto['cantidad'] = $cantidad;
			$producto['tipo_producto'] = $tipo_producto;
			$carrito[$producto_key] = $producto;
		}

		$this->session->set_userdata('carrito', $carrito);
		$this->session->set_flashdata('success', 'Se agregó al carrito');

		// Redirigir de nuevo a la vista que corresponde
		if ($tipo_producto == 'manteleria') {
			redirect('Welcome/manteleria');
		} elseif ($tipo_producto == 'vajilla') {
			redirect('Welcome/vajilla');
		}
	}





	public function carrito()
	{
		$data['carrito'] = $this->session->userdata('carrito') ?: array();
		$total = 0;
		foreach ($data['carrito'] as $item) {
			$total += $item['precio'] * $item['cantidad'];
		}

		$data['total'] = $total;
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('carrito', $data);
	}
	public function guardar_reserva()
	{
		// Asegurarnos de que no se haya enviado ninguna salida antes
		if (!headers_sent()) {
			header('Content-Type: application/json');
		}

		$this->load->model('Reservas_model');
		$this->load->model('Reserva_detalle_model');

		$usuario_id = $this->session->userdata('usuario_id');
		$fecha_reserva = $this->input->post('fecha_reserva');
		$dias = $this->input->post('dias');
		$evento = $this->input->post('evento');
		$detalle_evento = $this->input->post('detalle_evento');
		$monto_total = $this->input->post('monto_total');

		$garzones = $this->input->post('garzones');
		$cantidad_garzones = $this->input->post('cantidad_garzones');

		$carrito = $this->session->userdata('carrito');

		if (empty($carrito)) {
			echo json_encode([
				'success' => false,
				'message' => 'No puedes hacer una reserva con el carrito vacío.'
			]);
			exit;
		}

		if ($this->Reservas_model->verificar_disponibilidad_fecha($fecha_reserva, $dias)) {
			echo json_encode([
				'success' => false,
				'message' => 'Las fechas seleccionadas ya están reservadas. Por favor elige otras fechas.'
			]);
			exit;
		}

		if ($garzones === 'si') {
			$garzones_value = $cantidad_garzones;
		} else {
			$garzones_value = '0';
		}

		try {
			$this->db->trans_start();

			$reserva_id = $this->Reservas_model->guardar_reserva(
				$usuario_id,
				$fecha_reserva,
				$evento,
				$dias,
				$monto_total,
				$detalle_evento,
				$garzones_value
			);

			foreach ($carrito as $item) {
				$this->Reserva_detalle_model->guardar_detalle(
					$reserva_id,
					$item['vajilla_id'] ?? null,
					$item['manteleria_id'] ?? null,
					$item['cantidad'],
					$item['precio']
				);
			}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Error en la transacción de la base de datos');
			}

			$this->session->unset_userdata('carrito');

			echo json_encode([
				'success' => true,
				'message' => 'La solicitud del servicio se ha realizado con éxito. Se enviará la confirmación a su correo electrónico.'
			]);
			exit;

		} catch (Exception $e) {
			echo json_encode([
				'success' => false,
				'message' => 'Hubo un error al procesar la reserva: ' . $e->getMessage()
			]);
			exit;
		}
	}
	public function obtener_detalles_reserva($reserva_id)
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
			return;
		}

		try {
			// Obtener detalles de la reserva con información de usuarios
			$this->db->select('r.*, 
				u_cliente.nombre as cliente_nombre,
				u_cliente.primerApellido as cliente_primerApellido,
				u_cliente.segundoApellido as cliente_segundoApellido,
				u_aprobado.nombre as aprobado_nombre,
				u_aprobado.primerApellido as aprobado_primerApellido,
				u_aprobado.segundoApellido as aprobado_segundoApellido,
				u_entregado.nombre as entregado_nombre,
				u_entregado.primerApellido as entregado_primerApellido,
				u_entregado.segundoApellido as entregado_segundoApellido,
				u_recogido.nombre as recogido_nombre,
				u_recogido.primerApellido as recogido_primerApellido,
				u_recogido.segundoApellido as recogido_segundoApellido');
			$this->db->from('Reservas r');
			$this->db->join('Usuarios u_cliente', 'r.usuario_id = u_cliente.usuario_id', 'left');
			$this->db->join('Usuarios u_aprobado', 'r.aprobado_por = u_aprobado.usuario_id', 'left');
			$this->db->join('Usuarios u_entregado', 'r.entregado_por = u_entregado.usuario_id', 'left');
			$this->db->join('Usuarios u_recogido', 'r.recogido_por = u_recogido.usuario_id', 'left');
			$this->db->where('r.reserva_id', $reserva_id);
			$reserva = $this->db->get()->row();

			// Formatear nombres completos
			if ($reserva) {
				$reserva->aprobado_por_nombre = $reserva->aprobado_nombre ?
					$reserva->aprobado_nombre . ' ' . $reserva->aprobado_primerApellido . ' ' . $reserva->aprobado_segundoApellido :
					'No asignado';

				$reserva->entregado_por_nombre = $reserva->entregado_nombre ?
					$reserva->entregado_nombre . ' ' . $reserva->entregado_primerApellido . ' ' . $reserva->entregado_segundoApellido :
					'No asignado';

				$reserva->recogido_por_nombre = $reserva->recogido_nombre ?
					$reserva->recogido_nombre . ' ' . $reserva->recogido_primerApellido . ' ' . $reserva->recogido_segundoApellido :
					'No asignado';
			}

			// Obtener los detalles de items
			$this->db->select('rd.*, v.nombre as nombre_vajilla, m.nombre as nombre_manteleria');
			$this->db->from('Reserva_Detalles rd');
			$this->db->join('Vajilla v', 'rd.vajilla_id = v.vajilla_id', 'left');
			$this->db->join('Manteleria m', 'rd.manteleria_id = m.manteleria_id', 'left');
			$this->db->where('rd.reserva_id', $reserva_id);
			$detalles = $this->db->get()->result();

			$response = array(
				'reserva' => $reserva,
				'detalles' => $detalles
			);

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));

		} catch (Exception $e) {
			$this->output
				->set_content_type('application/json')
				->set_status_header(500)
				->set_output(json_encode(['error' => $e->getMessage()]));
		}
	}
	public function confirmacion_reserva()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('confirmacion_reserva', $data);
	}


	public function eliminar_producto_carrito()
	{
		header('Content-Type: application/json');

		$id = $this->input->post('id');
		$tipo = $this->input->post('tipo');
		$cantidad = $this->input->post('cantidad');

		$carrito = $this->session->userdata('carrito');
		$producto_key = false;

		try {
			$this->db->trans_start();

			// Buscar y actualizar según el tipo de producto
			if ($tipo == 'vajilla') {
				// Verificar que el producto existe
				$producto = $this->db->get_where('Vajilla', ['vajilla_id' => $id])->row();
				if ($producto) {
					// Actualizar stock_cajas en la tabla Vajilla
					$nuevo_stock = $producto->stock_cajas + $cantidad;
					$this->db->where('vajilla_id', $id);
					$this->db->update('Vajilla', ['stock_cajas' => $nuevo_stock]);

					// Buscar en el carrito
					foreach ($carrito as $key => $item) {
						if (isset($item['vajilla_id']) && $item['vajilla_id'] == $id) {
							$producto_key = $key;
							break;
						}
					}
				}
			} else if ($tipo == 'manteleria') {
				// Verificar que el producto existe
				$producto = $this->db->get_where('Manteleria', ['manteleria_id' => $id])->row();
				if ($producto) {
					// Actualizar stock en la tabla Manteleria
					$nuevo_stock = $producto->stock + $cantidad;
					$this->db->where('manteleria_id', $id);
					$this->db->update('Manteleria', ['stock' => $nuevo_stock]);

					// Buscar en el carrito
					foreach ($carrito as $key => $item) {
						if (isset($item['manteleria_id']) && $item['manteleria_id'] == $id) {
							$producto_key = $key;
							break;
						}
					}
				}
			}

			// Si se encontró el producto en el carrito, eliminarlo
			if ($producto_key !== false) {
				unset($carrito[$producto_key]);
				$carrito = array_values($carrito);
				$this->session->set_userdata('carrito', $carrito);
			}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				throw new Exception('Error al actualizar la base de datos');
			}

			echo json_encode([
				'success' => true,
				'message' => 'Producto eliminado correctamente'
			]);

		} catch (Exception $e) {
			// Si hay error, hacer rollback automático
			echo json_encode([
				'success' => false,
				'message' => 'Error al eliminar el producto: ' . $e->getMessage()
			]);
		}
	}

	public function vaciar_carrito()
	{
		$this->session->unset_userdata('carrito');
		redirect('Welcome/carrito');
	}


	public function eliminar_del_carrito($producto_id, $producto_tipo)
	{
		if ($producto_tipo == 'decoracion') {
			$this->db->delete('Carrito', array('decoracion_id' => $producto_id));
		} elseif ($producto_tipo == 'vajilla') {
			$this->db->delete('Carrito', array('vajilla_id' => $producto_id));
		}

		$carrito = $this->session->userdata('carrito') ?: array();
		$producto_key = $producto_tipo . '_' . $producto_id;

		if (isset($carrito[$producto_key])) {
			unset($carrito[$producto_key]);
			$this->session->set_userdata('carrito', $carrito);
		}

		redirect('Welcome/carrito');
	}

	public function decoracion()
	{
		$this->load->model('Decoracion_model');
		$this->session->set_userdata('cart', []);
		$data['decoracion'] = $this->Decoracion_model->get_all_decoraciones();

		$data['nombre'] = $this->session->userdata('nombre');

		$this->load->view('decoracion', $data);
	}
	public function manteleria()
	{
		$this->load->model('Manteleria_model');
		$this->session->set_userdata('cart', []);
		$data['productos'] = $this->Manteleria_model->get_all_products();

		$data['nombre'] = $this->session->userdata('nombre');

		$this->load->view('manteleria', $data);
	}

	public function bebidas()
	{
		$this->load->model('Bebida_model');
		$data['productos'] = $this->Bebida_model->get_all_bebidas();
		$this->session->set_userdata('cart', []);

		$data['nombre'] = $this->session->userdata('nombre');

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

		$contraseña_actual = $this->input->post('contraseña_actual');
		$nueva_contraseña = $this->input->post('nueva_contraseña');

		$usuario = $this->Usuario_model->get_usuario_by_id($usuario_id);

		if (password_verify($contraseña_actual, $usuario->password)) {
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'usuario' => $this->input->post('usuario'),
				'celular' => $this->input->post('celular')
			);

			if (!empty($nueva_contraseña)) {
				$data['password'] = password_hash($nueva_contraseña, PASSWORD_BCRYPT);

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

	public function validarCorreo()
	{
		$email = $this->input->post('usuario');
		log_message('debug', 'Iniciando validación de correo: ' . $email);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo json_encode(['success' => false, 'message' => 'Formato de correo inválido']);
			return;
		}
		$codigo = rand(100000, 999999);
		$this->session->set_userdata('codigo_verificacion', (string) $codigo); // Convertir a string
		$this->session->set_userdata('email_temporal', $email);

		log_message('debug', 'Código generado: ' . $codigo);
		log_message('debug', 'Código en sesión: ' . $this->session->userdata('codigo_verificacion'));

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

		$this->load->library('email', $config);
		$this->email->from('tu_email@gmail.com', 'Gustavo Marquez');
		$this->email->to($email);
		$this->email->subject('Código de Verificación');
		$this->email->message('Tu código de verificación es: ' . $codigo);

		if ($this->email->send()) {
			echo json_encode([
				'success' => true,
				'message' => 'Código de verificación enviado',
				'debug_code' => $codigo
			]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Error al enviar el código']);
		}
	}

	public function verificarCodigo()
	{
		$codigo_ingresado = $this->input->post('codigo');
		$codigo_correcto = $this->session->userdata('codigo_verificacion');

		if ($codigo_ingresado === $codigo_correcto) {
			$this->session->set_userdata('email_verificado', true);
			echo json_encode([
				'success' => true,
				'message' => 'Código verificado correctamente'
			]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Código incorrecto'
			]);
		}
	}
	public function salir()
	{
		$this->session->sess_destroy();
		redirect('Welcome/index');
	}
	public function registrarusuariobd()
	{
		// Solo verificamos que el email esté verificado
		if (!$this->session->userdata('email_verificado')) {
			$data['error'] = 'El email no ha sido verificado';
			$this->load->view('registrarse', $data);
			return;
		}

		// Verificar que el email sea el mismo que se verificó
		if ($this->session->userdata('email_temporal') != $this->input->post('usuario')) {
			$data['error'] = 'El correo electrónico no coincide con el verificado';
			$this->load->view('registrarse', $data);
			return;
		}

		$password = bin2hex(random_bytes(8));

		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'usuario' => $this->input->post('usuario'),
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'celular' => $this->input->post('celular'),
			'estado' => 1, // Usuario verificado
			'fechaCreacionUsuario' => date('Y-m-d H:i:s'),
			'fechaActualizacionUsuario' => null
		);

		// Validación de campos requeridos
		if (empty($data['nombre']) || empty($data['usuario']) || empty($data['celular'])) {
			$data['error'] = 'Todos los campos son obligatorios';
			$this->load->view('registrarse', $data);
			return;
		}

		// Verificar si el correo ya existe
		if ($this->login_model->existeUsuarioPorCorreo($data['usuario'])) {
			$data['error'] = 'El correo ya está registrado';
			$this->load->view('registrarse', $data);
			return;
		}

		// Agregar usuario a la base de datos
		$this->login_model->agregarusuario($data);

		// Configuración del email
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

		// Enviar contraseña por correo
		$this->load->library('email', $config);
		$this->email->from('tu_email@gmail.com', 'Gustavo Marquez');
		$this->email->to($data['usuario']);
		$this->email->subject('Tu Contraseña');
		$this->email->message('Tu cuenta ha sido creada. Tu contraseña es: ' . $password);

		if ($this->email->send()) {
			// Limpiar la sesión después del registro exitoso
			$this->session->unset_userdata('email_verificado');
			$this->session->unset_userdata('email_temporal');
			$this->session->unset_userdata('codigo_verificacion');

			$data['success'] = 'Se envió su contraseña a ' . $data['usuario'];
		} else {
			$data['error'] = 'Correo no enviado: ' . $this->email->print_debugger();
		}

		$this->load->view('welcome_message', $data);
	}

	public function editUser($usuario_id)
	{
		$this->load->model('Usuario_model');

		$data['usuario'] = $this->Usuario_model->getUserById($usuario_id);
		$data['nombre'] = $this->session->userdata('nombre');
		if (!$data['usuario']) {
			show_404();
		}

		$this->load->view('administrador/editarUsuario', $data);
	}
	public function AdminConfiguracion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$data['nombre'] = $this->session->userdata('nombre');
		if ($usuario_id) {
			$this->load->model('Usuario_model');
			$data['usuario'] = $this->Usuario_model->get_usuario_by_id($usuario_id);

			if ($data['usuario']) {
				$this->load->view('administrador/AdminConfiguracion', $data);
			} else {
				redirect('Welcome/error');
			}
		} else {
			redirect('Welcome/index');
		}
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
			'estado' => $this->input->post('estado'),
			'rol' => $this->input->post('rol')
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

		$usuario = $this->login_model->obtenerUsuarioPorEmail($user);

		if ($usuario && password_verify($password, $usuario->password)) {
			$this->session->set_userdata('usuario_id', $usuario->usuario_id);
			$this->session->set_userdata('nombre', $usuario->nombre . ' ' . $usuario->primerApellido);

			switch ($usuario->rol) {
				case "cliente":
					redirect('Welcome/inicio');
					break;
				case "administrador":
					redirect('Welcome/admin');
					break;
				default:
					$data['error'] = 'Rol de usuario no válido';
					$this->load->view('welcome_message', $data);
					break;
			}
		} else {
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('welcome_message', $data);
		}
	}
	public function detalles($reserva_id)
	{
		$this->load->model('Reservas_model');
		$this->load->model('Reserva_detalle_model');
		$this->load->model('Garzones_reservas_model');
		$data['nombre'] = $this->session->userdata('nombre');
		$data['reserva'] = $this->Reservas_model->get_reserva_by_id($reserva_id); // Obtiene la reserva
		$data['detalles'] = $this->Reserva_detalle_model->get_detalles_by_reserva($reserva_id);
		$data['empleados'] = $this->Empleado_model->get_all_empleados();
		$data['garzones_asignados'] = $this->Garzones_reservas_model->obtener_garzones_por_reserva($reserva_id);
		$this->load->view('administrador/detalles_reserva', $data);
	}
	public function eliminarDetalle($detalle_id)
	{
		$this->load->model('Reserva_detalle_model');
		$this->load->model('Reservas_model');
		$this->load->model('Vajilla_model');
		$this->load->model('Manteleria_model');

		$detalle = $this->Reserva_detalle_model->get_detalle_by_id($detalle_id);

		if ($detalle) {
			$reserva_id = $detalle->reserva_id;
			$precio_detalle = $detalle->cantidad * $detalle->precio;

			// Devolver el stock según el tipo de item
			if ($detalle->vajilla_id) {
				$this->Vajilla_model->incrementar_stock_vajilla($detalle->vajilla_id, $detalle->cantidad);
			} elseif ($detalle->manteleria_id) {
				$this->Manteleria_model->incrementar_stock_manteleria($detalle->manteleria_id, $detalle->cantidad);
			}

			// Resta el monto del detalle del total de la reserva y elimina el detalle
			if ($this->Reservas_model->restar_monto_total($reserva_id, $precio_detalle)) {
				if ($this->Reserva_detalle_model->eliminar_detalle($detalle_id)) {
					$this->session->set_flashdata('success', 'Detalle eliminado correctamente y stock actualizado.');
				} else {
					$this->session->set_flashdata('error', 'Error al eliminar el detalle.');
				}
			} else {
				$this->session->set_flashdata('error', 'Error al actualizar el monto total de la reserva.');
			}
		} else {
			$this->session->set_flashdata('error', 'Detalle no encontrado.');
		}
		redirect('Welcome/detalles/' . $reserva_id);
	}

	public function actualizarCantidad($detalle_id)
	{
		$this->load->model('Reserva_detalle_model');
		$this->load->model('Reservas_model');
		$nueva_cantidad = $this->input->post('cantidad');

		if ($nueva_cantidad > 0) {
			// Obtén el detalle usando el detalle_id
			$detalle = $this->Reserva_detalle_model->get_detalle_by_id($detalle_id);

			if ($detalle) {
				// Actualiza la cantidad del detalle
				$this->Reserva_detalle_model->actualizar_cantidad($detalle_id, $nueva_cantidad);

				// Calcula el precio total del detalle
				$precio_total_detalle = $nueva_cantidad * $detalle->precio;

				// Obtén el reserva_id y garzones de la reserva asociada
				$reserva_id = $detalle->reserva_id;
				$reserva = $this->Reservas_model->get_reserva_by_id($reserva_id); // Asegúrate de tener este método en el modelo
				$garzones = isset($reserva->garzones) ? $reserva->garzones : 0; // Obtén la cantidad de garzones

				// Calcula el nuevo monto total incluyendo el costo de los garzones
				$monto_total = $this->Reservas_model->calcular_monto_total($reserva_id, $garzones);

				// Actualiza el monto total en la reserva
				$this->Reservas_model->actualizar_monto_total($reserva_id, $monto_total);

				// Mensaje de éxito
				$this->session->set_flashdata('success', 'Cantidad actualizada correctamente.');
			} else {
				// Mensaje de error si no se encuentra el detalle
				$this->session->set_flashdata('error', 'Detalle no encontrado.');
			}
		} else {
			// Mensaje de error si la cantidad no es válida
			$this->session->set_flashdata('error', 'La cantidad debe ser mayor a 0.');
		}

		// Redirige a la página de detalles de la reserva
		redirect('Welcome/detalles/' . $detalle->reserva_id);
	}



	public function empleados()
	{
		$data['empleados'] = $this->Empleado_model->get_all_empleados();
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('Empleado/empleados', $data);
	}
	public function agregar_empleado()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('Empleado/agregar_empleado');
	}

	// Guardar empleado
	public function guardar_empleado()
	{
		$nombre = $this->input->post('nombre');
		$apellido_paterno = $this->input->post('apellido_paterno');
		$apellido_materno = $this->input->post('apellido_materno');
		$celular = $this->input->post('celular');

		if ($this->Empleado_model->celular_existe($celular)) {
			$this->session->set_flashdata('error', 'El celular ya está registrado.');
			redirect('Welcome/agregar_empleado');
		}

		if ($this->Empleado_model->nombre_existe($nombre, $apellido_paterno, $apellido_materno)) {
			$this->session->set_flashdata('error', 'El empleado ya está registrado.');
			redirect('Welcome/agregar_empleado');
		}

		$data = array(
			'nombre' => $nombre,
			'apellido_paterno' => $apellido_paterno,
			'apellido_materno' => $apellido_materno,
			'celular' => $celular
		);

		$this->Empleado_model->insert_empleado($data);
		$this->session->set_flashdata('success_message', 'Empleado agregado correctamente.');
		redirect('Welcome/empleados');
	}



	// Cargar vista para editar empleado
	public function editar_empleado($empleado_id)
	{
		$data['empleado'] = $this->Empleado_model->get_empleado_by_id($empleado_id);
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('Empleado/editar_empleado', $data);
	}

	// Actualizar empleado
	// Modify your controller method to handle AJAX request
	public function actualizar_empleado($empleado_id)
	{
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'apellido_paterno' => $this->input->post('apellido_paterno'),
			'apellido_materno' => $this->input->post('apellido_materno'),
			'celular' => $this->input->post('celular')
		);

		$this->Empleado_model->update_empleado($empleado_id, $data);

		// If it's an AJAX request, return JSON response
		if ($this->input->is_ajax_request()) {
			echo json_encode(['success' => true]);
			return;
		}

		// For non-AJAX requests, redirect as before
		redirect('Welcome/empleados');
	}

	// Eliminar empleado
	public function eliminar_empleado($empleado_id)
	{
		$data = array('estado' => 0);
		$this->db->where('empleado_id', $empleado_id);
		$this->db->update('Empleados', $data);

		// Establece un mensaje de flash
		$this->session->set_flashdata('success_message', 'Empleado eliminado correctamente.');

		redirect('Welcome/empleados');
	}
	public function reactivar_empleado($empleado_id)
	{
		$data = array('estado' => 1); // Cambia el estado a 1 para reactivar
		$this->db->where('empleado_id', $empleado_id);
		$this->db->update('Empleados', $data);

		// Mensaje de éxito
		$this->session->set_flashdata('success_message', 'Empleado reactivado correctamente.');

		redirect('Welcome/empleados');
	}



	public function admin()
	{
		$this->check_session_and_load_view('administrador/admin');
	}
	public function empleado()
	{
		$this->check_session_and_load_view('empleado/empleado');
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



	public function eliminarUsuario($usuario_id)
	{
		if ($this->Usuario_model->eliminar_usuario($usuario_id)) {
			$this->session->set_flashdata('success', 'Usuario eliminado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al eliminar el usuario.');
		}
		redirect('Welcome/adminUser');
	}
	public function activarUsuario($usuario_id)
	{
		// Cargar el modelo de usuarios
		$this->load->model('Usuario_model');

		// Llamar a la función del modelo para activar al usuario
		if ($this->Usuario_model->activar_usuario($usuario_id)) {
			$this->session->set_flashdata('success', 'Usuario activado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al activar el usuario.');
		}

		// Redirigir a la página de detalles o la lista de usuarios
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
			$this->load->view('administrador/adminVajilla', $data);
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
			'cantidad' => $this->input->post('cantidad'),
			'stock_cajas' => $this->input->post('stock_cajas'),
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
		$data['nombre'] = $this->session->userdata('nombre');
		if (empty($data['vajilla'])) {
			show_404(); // Muestra un error 404 si no se encuentra el producto
		}

		$this->load->view('administrador/editVajilla', $data);
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
			'cantidad' => $this->input->post('cantidad'),
			'stock_cajas' => $this->input->post('stock_cajas'),
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
			$this->load->view('administrador/admin', $data); // Asegúrate de cargar la vista correcta
			return;
		} else {
			// Imagen cargada exitosamente
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		}

		// Recoger datos del formulario
		$nombre = $this->input->post('nombre');
		$precio = $this->input->post('precio');
		$tipo = $this->input->post('tipo');

		// Validar que el nombre no esté vacío
		if (empty($nombre)) {
			$data['error'] = 'El campo "Tipo" es obligatorio.';
			$this->load->view('admin', $data);
			return;
		}

		$data = array(
			'nombre' => $nombre,
			'precio' => $precio,
			'tipo' => $tipo,
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
	public function agregarManteleria()
	{
		// Configuración de la carga de imágenes
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 2048; // Tamaño máximo en KB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('imagen')) {
			// Error al cargar la imagen
			$data['error'] = $this->upload->display_errors();
			$this->load->view('administrador/admin', $data); // Asegúrate de cargar la vista correcta
			return;
		} else {
			// Imagen cargada exitosamente
			$upload_data = $this->upload->data();
			$imagen = $upload_data['file_name'];
		}

		// Recoger datos del formulario
		$nombre = $this->input->post('nombre');
		$tipo = $this->input->post('tipo');
		$precio = $this->input->post('precio');
		$stock = $this->input->post('stock');
		// Validar que el nombre no esté vacío
		if (empty($nombre)) {
			$data['error'] = 'El campo "Tipo" es obligatorio.';
			$this->load->view('admin', $data);
			return;
		}

		$data = array(
			'nombre' => $nombre,
			'tipo' => $tipo,
			'precio' => $precio,
			'stock' => $stock,
			'imagen' => $imagen
		);

		// Guardar en la base de datos
		if ($this->Manteleria_model->insert_manteleria($data)) {
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

		$this->load->view('administrador/CrudDecoracion', $data); // Cargar la vista con los datos
	}
	public function adminMantelerias()
	{
		$data['nombre'] = $this->session->userdata('nombre'); // Obtener el nombre del usuario de la sesión
		$data['manteleria'] = $this->Manteleria_model->get_all_manteleria(); // Obtener todas las decoraciones

		$this->load->view('administrador/CrudManteleria', $data); // Cargar la vista con los datos
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
			$data['nombre'] = $this->session->userdata('nombre');
			$this->load->view('administrador/EditarDecoracion', $data);
		}
	}
	public function editarManteleria($id)
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
				'nombre' => $this->input->post('nombre'),
				'tipo' => $this->input->post('tipo'),
				'precio' => $this->input->post('precio'),
				'stock' => $this->input->post('stock'),
				'imagen' => $imagen
			);

			if ($this->Manteleria_model->update_manteleria($id, $data)) {
				// Redirigir o mostrar un mensaje de éxito
				redirect('Welcome/adminMantelerias');
			} else {
				// Mostrar mensaje de error
				echo 'Error al actualizar la manteleria.';
			}
		} else {
			// Cargar datos de la decoración y mostrar el formulario
			$data['manteleria'] = $this->Manteleria_model->get_manteleria_by_id($id);
			$data['nombre'] = $this->session->userdata('nombre');
			$this->load->view('administrador/EditarManteleria', $data);
		}
	}

	public function deleteDecoracion($id)
	{
		$this->Decoracion_model->delete_decoracion($id); // Eliminar decoración por ID
		redirect('Welcome/adminDecoraciones'); // Redirigir a la lista de decoraciones
	}
	public function deleteManteleria($id)
	{
		$this->Manteleria_model->delete_manteleria($id); // Eliminar decoración por ID
		redirect('Welcome/adminMantelerias'); // Redirigir a la lista de decoraciones
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
				'detalles' => $this->input->post('detalles'),
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
			$this->load->view('administrador/agregar_bebida');
		}
	}
	public function editarBebida($id)
	{
		$data['bebida'] = $this->Bebida_model->get_bebida_by_id($id);
		$data['nombre'] = $this->session->userdata('nombre'); // Asegúrate de tener el nombre del usuario en sesión
		$this->load->view('administrador/editar_bebida', $data);
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