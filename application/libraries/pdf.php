<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . "/third_party/fpdf/fpdf.php";

class Pdf extends FPDF
{
    private $fecha_generacion;

    public function __construct()
    {
        parent::__construct();
        $this->fecha_generacion = date('d/m/Y H:i:s');
    }

    // Método para limpiar texto con caracteres especiales
    protected function cleanText($text)
    {
        return iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $text);
    }

    // Sobrescribir Cell para manejar caracteres especiales
    public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        parent::Cell($w, $h, $this->cleanText($txt), $border, $ln, $align, $fill, $link);
    }

    // Sobrescribir MultiCell para manejar caracteres especiales
    public function MultiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false)
    {
        parent::MultiCell($w, $h, $this->cleanText($txt), $border, $align, $fill);
    }

    public function Header()
    {
        // Fecha de generación
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 5, 'Fecha de generacion: ' . $this->fecha_generacion, 0, 1, 'R');

        $this->Ln(5); // Espacio después del encabezado
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 7);
        $this->Cell(0, 10, 'Pag. ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}
?>