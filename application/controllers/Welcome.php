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
	// En el controlador Welcome.php

	public function exportar_reporte_fechas()
	{
		// Obtener las fechas del POST
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		// Obtener las reservas usando las mismas fechas
		$reservas = $this->Reservas_model->obtener_reservas_por_fechas($fecha_inicio, $fecha_fin);

		if (empty($reservas)) {
			redirect('Welcome/reportes');
			return;
		}

		// Inicializar PDF
		$this->load->library('pdf');
		$pdf = new Pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage('L');

		// Calcular el ancho total de la tabla
		$anchoTabla = 260;
		$margenIzquierdo = (297 - $anchoTabla) / 2;

		// Establecer márgenes
		$pdf->SetLeftMargin($margenIzquierdo);
		$pdf->SetRightMargin($margenIzquierdo);

		// Subtítulo con fechas
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($fecha_inicio)) . ' - ' . date('d/m/Y', strtotime($fecha_fin)), 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, 'El Detalle Eventos - Reporte por Fechas', 0, 1, 'C');
		// Cabeceras de la tabla
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetFillColor(200, 200, 200);

		// Definir anchos de columnas
		$pdf->Cell(20, 8, 'N°', 1, 0, 'C', true);
		$pdf->Cell(70, 8, 'Cliente', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Tipo de Evento', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Fecha', 1, 0, 'C', true);
		$pdf->Cell(15, 8, 'Dias', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Monto Total', 1, 0, 'C', true);
		$pdf->Cell(50, 8, 'Estado', 1, 1, 'C', true);

		// Contenido de la tabla
		$pdf->SetFont('Arial', '', 10);
		$total_general = 0;
		$numero = 1;

		foreach ($reservas as $reserva) {
			$nombre_completo = $reserva->cliente_nombre . ' ' .
				$reserva->cliente_primerApellido . ' ' .
				$reserva->cliente_segundoApellido;
			$pdf->Cell(20, 8, $numero, 1, 0, 'C');
			$pdf->Cell(70, 8, $nombre_completo, 1, 0, 'L');
			$pdf->Cell(35, 8, $reserva->tipo_evento, 1, 0, 'L');
			$pdf->Cell(30, 8, date('d/m/Y', strtotime($reserva->fecha_reserva)), 1, 0, 'C');
			$pdf->Cell(15, 8, $reserva->dias, 1, 0, 'C');
			$pdf->Cell(30, 8, 'Bs. ' . number_format($reserva->monto_total, 2), 1, 0, 'R');
			$pdf->Cell(50, 8, $reserva->estado_pago, 1, 1, 'L');

			$total_general += $reserva->monto_total;
			$numero++;
		}

		// Total General
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(150, 8, 'TOTAL GENERAL:', 1, 0, 'R', true);
		$pdf->Cell(100, 8, 'Bs. ' . number_format($total_general, 2), 1, 1, 'R', true);

		// Generar el PDF
		$pdf->Output('D', 'reporte_reservas_' . date('Y-m-d') . '.pdf');
	}
	public function tipo_evento()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('administrador/tipo_evento', $data);
	}
	public function reporte_evento()
	{
		$data['nombre'] = $this->session->userdata('nombre');

		if ($this->input->post()) {
			$eventos = $this->Reservas_model->obtener_eventos_por_tipo(
				$this->input->post('evento'),
				$this->input->post('fecha_inicio'),
				$this->input->post('fecha_fin')
			);

			// Guardar en sesión para el PDF
			$this->session->set_userdata('eventos', $eventos);

			// Preparar datos para la vista
			$data['eventos'] = $eventos;
			$data['evento_seleccionado'] = $this->input->post('evento');
			$data['fecha_inicio'] = $this->input->post('fecha_inicio');
			$data['fecha_fin'] = $this->input->post('fecha_fin');
		}

		$this->load->view('administrador/tipo_evento', $data);
	}

	public function exportar_reporte_evento()
	{
		// Obtener datos del POST
		$tipo_evento = $this->input->post('evento');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		// Obtener eventos de la sesión
		$eventos = $this->session->userdata('eventos');

		// Inicializar PDF
		$this->load->library('pdf');
		$pdf = new Pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage('L');

		// Calcular el ancho total de la tabla (aumentado para la nueva columna)
		$anchoTabla = 250;
		$margenIzquierdo = (297 - $anchoTabla) / 2;

		// Establecer márgenes
		$pdf->SetLeftMargin($margenIzquierdo);
		$pdf->SetRightMargin($margenIzquierdo);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, 'El Detalle Eventos - Reporte por Evento', 0, 1, 'C');
		// Subtítulo con tipo de evento y fechas
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(0, 10, 'Tipo de Evento: ' . $tipo_evento, 0, 1, 'C');
		$pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($fecha_inicio)) . ' - ' . date('d/m/Y', strtotime($fecha_fin)), 0, 1, 'C');
		$pdf->Ln(5);

		// Cabeceras de la tabla
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetFillColor(200, 200, 200);

		// Definir anchos de columnas (agregada columna para numeración)
		$pdf->Cell(20, 8, 'N°', 1, 0, 'C', true);
		$pdf->Cell(70, 8, 'Cliente', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Tipo de Evento', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Fecha', 1, 0, 'C', true);
		$pdf->Cell(15, 8, 'Dias', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Monto Total', 1, 0, 'C', true);
		$pdf->Cell(50, 8, 'Estado', 1, 1, 'C', true);

		// Contenido de la tabla
		$pdf->SetFont('Arial', '', 10);
		$total_general = 0;
		$numero = 1; // Inicializar contador

		foreach ($eventos as $evento) {
			$pdf->Cell(20, 8, $numero, 1, 0, 'C'); // Número de fila
			$pdf->Cell(70, 8, $evento->cliente_nombre . ' ' . $evento->cliente_primerApellido . ' ' . $evento->cliente_segundoApellido, 1, 0, 'L');
			$pdf->Cell(35, 8, $evento->tipo_evento, 1, 0, 'L');
			$pdf->Cell(30, 8, date('d/m/Y', strtotime($evento->fecha_reserva)), 1, 0, 'C');
			$pdf->Cell(15, 8, $evento->dias, 1, 0, 'C');
			$pdf->Cell(30, 8, 'Bs. ' . number_format($evento->monto_total, 2), 1, 0, 'R');
			$pdf->Cell(50, 8, $evento->estado_pago, 1, 1, 'L');

			$total_general += $evento->monto_total;
			$numero++; // Incrementar contador
		}

		// Total General
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(170, 8, 'TOTAL GENERAL:', 1, 0, 'R', true); // Ajustado el ancho para incluir la columna de numeración
		$pdf->Cell(80, 8, 'Bs. ' . number_format($total_general, 2), 1, 1, 'R', true);

		// Generar PDF
		$pdf->Output('D', 'reporte_evento_' . str_replace(' ', '_', $tipo_evento) . '_' . date('Y-m-d') . '.pdf');
	}
	public function reporte_empleado()
	{
		$data['nombre'] = $this->session->userdata('nombre');
		$data['empleados'] = $this->Reservas_model->obtener_empleados();

		if ($this->input->post()) {
			$empleado_id = $this->input->post('empleado');
			$fecha_inicio = $this->input->post('fecha_inicio');
			$fecha_fin = $this->input->post('fecha_fin');

			// Guardar datos en sesión para el PDF
			$this->session->set_userdata('empleado_id', $empleado_id);
			$this->session->set_userdata('fecha_inicio', $fecha_inicio);
			$this->session->set_userdata('fecha_fin', $fecha_fin);

			$data['eventos'] = $this->Reservas_model->obtener_eventos_empleado($empleado_id, $fecha_inicio, $fecha_fin);
			$data['empleado'] = $this->Reservas_model->obtener_empleado_por_id($empleado_id);

			// Mantener valores seleccionados
			$data['empleado_seleccionado'] = $empleado_id;
			$data['fecha_inicio'] = $fecha_inicio;
			$data['fecha_fin'] = $fecha_fin;
		} else {
			$data['eventos'] = null;
			$data['empleado'] = null;
		}

		$this->load->view('administrador/reporte_empleado', $data);
	}
	public function exportar_reporte_empleado()
	{
		// Obtener datos del POST
		$empleado_id = $this->input->post('empleado');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		// Obtener datos
		$eventos = $this->Reservas_model->obtener_eventos_empleado($empleado_id, $fecha_inicio, $fecha_fin);
		$empleado = $this->Reservas_model->obtener_empleado_por_id($empleado_id);

		// Inicializar PDF
		$this->load->library('pdf');
		$pdf = new Pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage('L');

		// Calcular el ancho total de la tabla
		$anchoTabla = 250; // Aumentado para acomodar la nueva columna
		$margenIzquierdo = (297 - $anchoTabla) / 2;

		// Establecer márgenes
		$pdf->SetLeftMargin($margenIzquierdo);
		$pdf->SetRightMargin($margenIzquierdo);

		// Título
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, 'El Detalle Eventos - Reporte de Empleado', 0, 1, 'C');

		// Subtítulo con datos del empleado y fechas
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(0, 10, 'Empleado: ' . $empleado->nombre . ' ' . $empleado->apellido_paterno . ' ' . $empleado->apellido_materno, 0, 1, 'C');
		$pdf->Cell(0, 10, 'Periodo: ' . date('d/m/Y', strtotime($fecha_inicio)) . ' - ' . date('d/m/Y', strtotime($fecha_fin)), 0, 1, 'C');
		$pdf->Ln(5);

		// Definir anchos de columnas (agregada nueva columna para numeración)
		$w = array(20, 70, 35, 30, 65, 30); // El primer valor (20) es el ancho de la columna de numeración

		// Cabeceras de la tabla
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetFillColor(200, 200, 200);
		$pdf->Cell($w[0], 8, 'N°', 1, 0, 'C', true);
		$pdf->Cell($w[1], 8, 'Empleado', 1, 0, 'C', true);
		$pdf->Cell($w[2], 8, 'Tipo de Evento', 1, 0, 'C', true);
		$pdf->Cell($w[3], 8, 'Fecha', 1, 0, 'C', true);
		$pdf->Cell($w[4], 8, 'Detalle del Evento', 1, 0, 'C', true);
		$pdf->Cell($w[5], 8, 'Dias', 1, 1, 'C', true);

		// Contenido de la tabla
		$pdf->SetFont('Arial', '', 10);
		$numero = 1; // Inicializar contador

		foreach ($eventos as $evento) {
			$garzon = $this->Reservas_model->obtener_nombre_empleado($evento->empleado_id);
			$nombre_empleado = $garzon ? $garzon->nombre . ' ' . $garzon->apellido_paterno . ' ' . $garzon->apellido_materno : 'No disponible';

			// Calcular altura necesaria para el detalle del evento
			$pdf->SetFont('Arial', '', 10);
			$alturaLinea = 6; // Altura mínima de línea
			$numLineas = ceil($pdf->GetStringWidth($evento->detalle_evento) / ($w[4] - 2));
			$altura = max($alturaLinea * $numLineas, $alturaLinea);

			// Guardar posición X inicial
			$x = $pdf->GetX();
			$y = $pdf->GetY();

			// Dibujar celdas con la misma altura
			$pdf->Cell($w[0], $altura, $numero, 1, 0, 'C'); // Número de fila
			$pdf->Cell($w[1], $altura, $nombre_empleado, 1, 0, 'L');
			$pdf->Cell($w[2], $altura, $evento->tipo_evento, 1, 0, 'L');
			$pdf->Cell($w[3], $altura, date('d/m/Y', strtotime($evento->fecha_reserva)), 1, 0, 'C');

			// Usar MultiCell para el detalle del evento
			$xDetalle = $pdf->GetX();
			$pdf->MultiCell($w[4], $alturaLinea, $evento->detalle_evento, 1, 'L');

			// Volver a la posición correcta para la siguiente celda
			$pdf->SetXY($xDetalle + $w[4], $y);
			$pdf->Cell($w[5], $altura, $evento->dias, 1, 1, 'C');

			$numero++; // Incrementar contador
		}

		// Generar PDF
		$pdf->Output('D', 'reporte_empleado_' . date('Y-m-d') . '.pdf');
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
						<td>' . $reserva->nombre_completo . '</td>
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
		$usuario_id = $this->session->userdata('usuario_id');

		// Obtener los detalles de la reserva antes de cancelarla
		$detalles = $this->Reservas_model->get_detalles_reserva($reserva_id);

		// Iniciar transacción
		$this->db->trans_start();

		try {
			// Variable para rastrear si todas las actualizaciones fueron exitosas
			$actualizaciones_exitosas = true;

			// Actualizar stocks para cada detalle
			foreach ($detalles as $detalle) {
				// Actualizar stock de vajilla
				if (!empty($detalle->vajilla_id)) {
					// Primero verificamos el stock actual
					$vajilla_actual = $this->db->get_where('Vajilla', ['vajilla_id' => $detalle->vajilla_id])->row();
					if ($vajilla_actual) {
						// Actualizamos el stock_cajas
						$this->db->set('stock_cajas', 'stock_cajas + ' . (int) $detalle->cantidad, FALSE);
						$this->db->where('vajilla_id', $detalle->vajilla_id);
						$actualizado = $this->db->update('Vajilla');

						if (!$actualizado) {
							$actualizaciones_exitosas = false;
							log_message('error', 'Error al actualizar stock de vajilla ID: ' . $detalle->vajilla_id);
						}
					}
				}

				// Actualizar stock de mantelería
				if (!empty($detalle->manteleria_id)) {
					// Primero verificamos el stock actual
					$manteleria_actual = $this->db->get_where('Manteleria', ['manteleria_id' => $detalle->manteleria_id])->row();
					if ($manteleria_actual) {
						// Actualizamos el stock
						$this->db->set('stock', 'stock + ' . (int) $detalle->cantidad, FALSE);
						$this->db->where('manteleria_id', $detalle->manteleria_id);
						$actualizado = $this->db->update('Manteleria');

						if (!$actualizado) {
							$actualizaciones_exitosas = false;
							log_message('error', 'Error al actualizar stock de mantelería ID: ' . $detalle->manteleria_id);
						}
					}
				}
			}

			if ($actualizaciones_exitosas) {
				// Actualizar estado de la reserva
				$this->Reservas_model->update_estado_reserva($reserva_id, 'Cancelado', $usuario_id);

				// Obtener datos de la reserva para el correo
				$reserva = $this->Reservas_model->get_reserva_con_usuario_by_id($reserva_id);

				if ($reserva) {
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
					$this->email->from('tu_email@gmail.com', 'El Detalle Eventos');
					$this->email->to($reserva->email);
					$this->email->subject('Cancelación de Solicitud');

					// Crear mensaje detallado
					$mensaje = "<p>Lamentamos informarte que tu solicitud ha sido cancelada.</p>";
					$mensaje .= "<p>Detalles de la cancelación:</p>";
					$mensaje .= "<ul>";
					$mensaje .= "<li>Número de Reserva: " . $reserva_id . "</li>";
					$mensaje .= "<li>Fecha de Cancelación: " . date('Y-m-d H:i:s') . "</li>";
					$mensaje .= "<li>Tipo de Evento: " . $reserva->tipo_evento . "</li>";
					$mensaje .= "<li>Fecha del Evento: " . $reserva->fecha_reserva . "</li>";
					$mensaje .= "</ul>";
					$mensaje .= "<p>Si tienes alguna pregunta, por favor contáctanos.</p>";

					$this->email->message($mensaje);

					if ($this->email->send()) {
						$this->db->trans_commit();
						$this->session->set_flashdata('success', 'Solicitud cancelada correctamente. Se ha actualizado el inventario y se ha enviado la notificación por correo.');
					} else {
						$this->db->trans_rollback();
						$this->session->set_flashdata('error', 'Error al enviar el correo de notificación.');
					}
				} else {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'No se encontró la información de la reserva.');
				}
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Error al actualizar el inventario.');
			}

		} catch (Exception $e) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Error al procesar la cancelación: ' . $e->getMessage());
			log_message('error', 'Error en cancelar_solicitud: ' . $e->getMessage());
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
		$this->Reservas_model->update_estado_recogida_vajilla($reserva_id, $nuevo_estado, $this->session->userdata('usuario_id'));
		$detalles = $this->Reservas_model->get_detalles_reserva($reserva_id);
		foreach ($detalles as $detalle) {
			if (!empty($detalle->vajilla_id)) {
				echo "Actualizando stock de vajilla ID: " . $detalle->vajilla_id . " Cantidad: " . $detalle->cantidad . "<br>";
				$this->db->set('stock_cajas', 'stock_cajas + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('vajilla_id', $detalle->vajilla_id);
				$this->db->update('Vajilla');
			}
			if (!empty($detalle->manteleria_id)) {
				echo "Actualizando stock de mantelería ID: " . $detalle->manteleria_id . " Cantidad: " . $detalle->cantidad . "<br>";
				$this->db->set('stock', 'stock + ' . (int) $detalle->cantidad, FALSE);
				$this->db->where('manteleria_id', $detalle->manteleria_id);
				$this->db->update('Manteleria');
			}
		}
		die();
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
		// Crear el array de datos
		$data = array(
			'nombre' => $this->session->userdata('nombre')
		);

		// Llamar a check_session_and_load_view con los parámetros correctos
		$this->check_session_and_load_view('administrador/adminUser', $data, true);
	}


	public function registro()
	{
		$this->session->unset_userdata('email_verificado');
		$this->session->unset_userdata('email_temporal');
		$this->session->unset_userdata('codigo_verificacion');

		// Cargar la vista de verificación de email1
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

		if ($garzones === 'si') {
			$reservas_con_garzones = $this->Reservas_model->contar_reservas_con_garzones($fecha_reserva, $dias);

			if ($reservas_con_garzones >= 2) {
				echo json_encode([
					'success' => false,
					'message' => 'Las fechas seleccionadas ya están reservadas. Por favor elige otras fechas.'
				]);
				exit;
			}
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

			// Guardamos temporalmente el carrito para el PDF
			$this->session->set_userdata('temp_carrito', $carrito);

			// Limpiamos el carrito original
			$this->session->unset_userdata('carrito');

			echo json_encode([
				'success' => true,
				'message' => 'La solicitud del servicio se ha realizado con éxito. Se enviará la confirmación a su correo electrónico.',
				'reserva_id' => $reserva_id // Agregamos el ID de la reserva si lo necesitamos
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
	public function generar_pdf_reserva()
	{
		$carrito = $this->session->userdata('temp_carrito');
		$fecha_reserva = $this->input->post('fecha_reserva');
		$dias = $this->input->post('dias');
		$evento = $this->input->post('evento');
		$detalle_evento = $this->input->post('detalle_evento');
		$garzones = $this->input->post('garzones');
		$cantidad_garzones = $this->input->post('cantidad_garzones');
		$monto_total = $this->input->post('monto_total');
		$usuario = $this->session->userdata('nombre');
		if (empty($carrito)) {
			$ultima_reserva = $this->Reservas_model->obtener_ultima_reserva($this->session->userdata('usuario_id'));
			if ($ultima_reserva) {
				$carrito = $this->obtener_datos_carrito_db($ultima_reserva->id);
			} else {
				$carrito = array();
			}
		}
		$this->load->library('pdf');
		$pdf = new Pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, 'El Detalle Eventos - Comprobante de Reserva', 0, 1, 'C');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 10, 'Informacion de la Reserva', 0, 1, 'L');

		$pdf->SetFont('Arial', '', 11);
		$pdf->Cell(40, 8, 'Cliente:', 0);
		$pdf->Cell(0, 8, $usuario, 0, 1);

		$pdf->Cell(40, 8, 'Fecha:', 0);
		$pdf->Cell(0, 8, date('d/m/Y', strtotime($fecha_reserva)), 0, 1);

		$pdf->Cell(40, 8, 'Dias:', 0);
		$pdf->Cell(0, 8, $dias, 0, 1);

		$pdf->Cell(40, 8, 'Evento:', 0);
		$pdf->Cell(0, 8, $evento, 0, 1);

		if (!empty($detalle_evento)) {
			$pdf->Cell(40, 8, 'Descripcion:', 0);
			$pdf->MultiCell(0, 8, $detalle_evento, 0);
		}
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 10, 'Detalle de Productos', 0, 1, 'L');
		$pdf->SetFillColor(200, 200, 200);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(80, 8, 'Producto', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Cantidad', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Precio Unit.', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Subtotal', 1, 1, 'C', true);
		$pdf->SetFont('Arial', '', 10);
		$subtotal = 0;
		if (!empty($carrito)) {
			foreach ($carrito as $item) {
				if (isset($item['tipo_producto']) && $item['tipo_producto'] == 'vajilla') {
					$subtotal_item = $item['precio'] * $item['cantidad'];
					$pdf->Cell(80, 8, $item['nombre'], 1, 0, 'L');
					$pdf->Cell(30, 8, $item['cantidad'] . ' (Cajas)', 1, 0, 'C');
					$pdf->Cell(35, 8, 'Bs. ' . number_format($item['precio'], 2), 1, 0, 'R');
					$pdf->Cell(35, 8, 'Bs. ' . number_format($subtotal_item, 2), 1, 1, 'R');
					$subtotal += $subtotal_item;
				}
			}
			foreach ($carrito as $item) {
				if (isset($item['tipo_producto']) && $item['tipo_producto'] == 'manteleria') {
					$subtotal_item = $item['precio'] * $item['cantidad'];
					$pdf->Cell(80, 8, $item['nombre'], 1, 0, 'L');
					$pdf->Cell(30, 8, $item['cantidad'] . ' (unididades)', 1, 0, 'C');
					$pdf->Cell(35, 8, 'Bs. ' . number_format($item['precio'], 2), 1, 0, 'R');
					$pdf->Cell(35, 8, 'Bs. ' . number_format($subtotal_item, 2), 1, 1, 'R');
					$subtotal += $subtotal_item;
				}
			}
		}
		if ($garzones == 'si' && $cantidad_garzones > 0) {
			$costo_garzones = $cantidad_garzones * 150;
			$pdf->Cell(80, 8, 'Servicio de Garzones', 1, 0, 'L');
			$pdf->Cell(30, 8, $cantidad_garzones, 1, 0, 'C');
			$pdf->Cell(35, 8, 'Bs. 150.00', 1, 0, 'R');
			$pdf->Cell(35, 8, 'Bs. ' . number_format($costo_garzones, 2), 1, 1, 'R');
			$subtotal += $costo_garzones;
		}
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(145, 8, 'TOTAL:', 1, 0, 'R', true);
		$pdf->Cell(35, 8, 'Bs. ' . number_format($monto_total, 2), 1, 1, 'R', true);
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 8, 'Terminos y Condiciones:', 0, 1);
		$pdf->SetFont('Arial', '', 9);
		$pdf->MultiCell(
			0,
			5,
			"1. Se requiere un adelanto del 35% para confirmar la reserva.\n" .
			"2. La cancelacion debe realizarse con al menos 48 horas de anticipacion.\n" .
			"3. El cliente es responsable por perdidas de bienes.\n" .
			"4. Los precios incluyen el transporte dentro de la ciudad."
		);
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'I', 8);
		$pdf->Cell(0, 5, 'Este documento es un comprobante de reserva y no un comprobante fiscal.', 0, 1, 'C');
		$this->session->unset_userdata('temp_carrito');
		$pdf->Output('D', 'reserva_el_detalle_eventos.pdf');
	}

	private function obtener_datos_carrito_db($reserva_id)
	{
		$this->load->model('Reserva_detalle_model');
		$detalles = $this->Reserva_detalle_model->obtener_detalles_reserva($reserva_id);

		$carrito = array();
		if ($detalles) {
			foreach ($detalles as $detalle) {
				$item = array(
					'nombre' => $detalle->nombre,
					'precio' => $detalle->precio,
					'cantidad' => $detalle->cantidad,
					'tipo_producto' => $detalle->vajilla_id ? 'vajilla' : 'manteleria',
					'vajilla_id' => $detalle->vajilla_id,
					'manteleria_id' => $detalle->manteleria_id
				);
				$carrito[] = $item;
			}
		}

		return $carrito;
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

		// Corregido el nombre del campo para que coincida con el formulario
		$contrasena_actual = $this->input->post('contrasena_actual');
		$nueva_contrasena = $this->input->post('nueva_contrasena');

		$usuario = $this->Usuario_model->get_usuario_by_id($usuario_id);

		if (password_verify($contrasena_actual, $usuario->password)) {
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'usuario' => $this->input->post('nombre_usuario'), // Corregido para coincidir con el formulario
				'celular' => $this->input->post('telefono')  // Corregido para coincidir con el formulario
			);

			if (!empty($nueva_contrasena)) {
				$data['password'] = password_hash($nueva_contrasena, PASSWORD_BCRYPT);

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
				$this->email->to($usuario->usuario);
				$this->email->subject('Cambio de Contraseña');
				$this->email->message('Tu contraseña ha sido cambiada exitosamente. La nueva contraseña es: ' . $nueva_contrasena);

				if ($this->email->send()) {
					$this->session->set_flashdata('success', 'Contraseña actualizada y notificación enviada a tu correo.');
				} else {
					$this->session->set_flashdata('error', 'Contraseña actualizada pero no se pudo enviar el correo: ' . $this->email->print_debugger());
				}
			}

			$this->Usuario_model->actualizar_usuario($usuario_id, $data);
			redirect('Welcome/configuracion');
		} else {
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
				'message' => 'Código de verificación enviadoooo',
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
	public function actualizarCuenta()
	{
		// Verificar si el usuario está logueado
		$usuario_id = $this->session->userdata('usuario_id');
		if (!$usuario_id) {
			redirect('Welcome/index');
			return;
		}

		$this->load->model('Usuario_model');
		$this->load->library('email');

		// Obtener datos del formulario
		$contrasena_actual = $this->input->post('contrasena_actual');
		$nueva_contrasena = $this->input->post('nueva_contrasena');

		// Obtener usuario actual
		$usuario = $this->Usuario_model->get_usuario_by_id($usuario_id);

		// Verificar contraseña actual
		if (password_verify($contrasena_actual, $usuario->password)) {
			// Preparar datos para actualizar
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'usuario' => $this->input->post('nombre_usuario'),
				'celular' => $this->input->post('telefono')
			);

			// Si se proporcionó una nueva contraseña, actualizarla
			if (!empty($nueva_contrasena)) {
				$data['password'] = password_hash($nueva_contrasena, PASSWORD_BCRYPT);

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

				// Preparar y enviar el correo
				$this->email->from('tu_email@gmail.com', 'El Detalle Eventos');
				$this->email->to($usuario->usuario);
				$this->email->subject('Cambio de Contraseña');
				$this->email->message('Tu contraseña ha sido cambiada exitosamente. La nueva contraseña es: ' . $nueva_contrasena);

				// Intentar enviar el correo
				if ($this->email->send()) {
					$this->session->set_flashdata('success', 'Contraseña actualizada y notificación enviada a tu correo.');
				} else {
					$this->session->set_flashdata('error', 'Contraseña actualizada pero no se pudo enviar el correo: ' . $this->email->print_debugger());
				}
			}

			// Actualizar datos del usuario
			$resultado = $this->Usuario_model->actualizar_usuario($usuario_id, $data);

			if ($resultado) {
				// Actualizar datos de sesión
				$this->session->set_userdata('nombre', $data['nombre']);
				$this->session->set_flashdata('success', 'Datos actualizados correctamente.');
			} else {
				$this->session->set_flashdata('error', 'Error al actualizar los datos.');
			}

			redirect('Welcome/AdminConfiguracion');
		} else {
			$this->session->set_flashdata('error', 'Contraseña actual no válida.');
			redirect('Welcome/AdminConfiguracion');
		}
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
	// En application/controllers/Welcome.php

	public function detalles($reserva_id)
	{
		$this->load->model('Reservas_model');
		$this->load->model('Reserva_detalle_model');
		$this->load->model('Garzones_reservas_model');
		$this->load->model('Empleado_model');

		$data['nombre'] = $this->session->userdata('nombre');

		// Obtiene la reserva
		$data['reserva'] = $this->Reservas_model->get_reserva_by_id($reserva_id);

		// Obtiene los detalles de la reserva
		$data['detalles'] = $this->Reserva_detalle_model->get_detalles_by_reserva($reserva_id);

		// Obtiene solo los empleados disponibles para las fechas de esta reserva
		$data['empleados'] = $this->Empleado_model->get_empleados_disponibles(
			$data['reserva']->fecha_reserva,
			$data['reserva']->dias,
			$reserva_id  // Pasar el ID de la reserva actual para excluirla
		);

		// Obtiene los garzones ya asignados a esta reserva
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
			$detalle = $this->Reserva_detalle_model->get_detalle_by_id($detalle_id);

			if ($detalle) {
				// Calcular la diferencia entre la nueva cantidad y la anterior
				$diferencia = $nueva_cantidad - $detalle->cantidad;

				// Iniciar transacción
				$this->db->trans_start();

				try {
					// Actualizar stock según el tipo de elemento
					if (!empty($detalle->vajilla_id)) {
						// Es un elemento de vajilla
						$vajilla = $this->db->get_where('Vajilla', ['vajilla_id' => $detalle->vajilla_id])->row();
						if ($vajilla) {
							// Restar la diferencia del stock
							$this->db->set('stock_cajas', "stock_cajas - $diferencia", FALSE);
							$this->db->where('vajilla_id', $detalle->vajilla_id);
							$this->db->update('Vajilla');
						}
					}

					if (!empty($detalle->manteleria_id)) {
						$manteleria = $this->db->get_where('Manteleria', ['manteleria_id' => $detalle->manteleria_id])->row();
						if ($manteleria) {
							// Restar la diferencia del stock
							$this->db->set('stock', "stock - $diferencia", FALSE);
							$this->db->where('manteleria_id', $detalle->manteleria_id);
							$this->db->update('Manteleria');
						}
					}

					// Actualizar la cantidad en el detalle
					$this->Reserva_detalle_model->actualizar_cantidad($detalle_id, $nueva_cantidad);

					// Calcular el precio total del detalle
					$precio_total_detalle = $nueva_cantidad * $detalle->precio;

					// Obtener reserva_id y garzones
					$reserva_id = $detalle->reserva_id;
					$reserva = $this->Reservas_model->get_reserva_by_id($reserva_id);
					$garzones = isset($reserva->garzones) ? $reserva->garzones : 0;

					// Calcular nuevo monto total
					$monto_total = $this->Reservas_model->calcular_monto_total($reserva_id, $garzones);

					// Actualizar monto total
					$this->Reservas_model->actualizar_monto_total($reserva_id, $monto_total);

					$this->db->trans_commit();
					$this->session->set_flashdata('success', 'Cantidad actualizada correctamente.');
				} catch (Exception $e) {
					$this->db->trans_rollback();
					$this->session->set_flashdata('error', 'Error al actualizar la cantidad: ' . $e->getMessage());
				}
			} else {
				$this->session->set_flashdata('error', 'Detalle no encontrado.');
			}
		} else {
			$this->session->set_flashdata('error', 'La cantidad debe ser mayor a 0.');
		}

		// Redirigir a la página de detalles
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