<?php
  require('fpdf.php');
  class PDF {

    private $pdf;
    private $nomb_archivo;
    public function __construct() {
      $this->pdf = new FPDF('P','mm','A4');
      $this->nomb_archivo =  "";
    }

    public function getNombreArchivo() {
      return $this->nomb_archivo;
    }

    public function construirPDF($cliente, $vehiculo, $pago) {
      $dir = utf8_decode("Dirección");
      $tel = utf8_decode("Teléfono");
      $alumbrado = utf8_decode("Alumbrado y señalización");
      $analisis = utf8_decode("Análisis de emisión");
      define('EURO', chr(128));
      $link = $this->pdf->AddLink();

      $this->pdf->AddPage();
      $this->pdf->SetFont("Arial","",20);
      $this->pdf->Cell(0, 12, "ITV", "B", 1, "C", false);

      $this->pdf->SetTextColor(183,28,28);
      $this->pdf->SetFont("Arial","",16);
      $this->pdf->Cell(0, 10, "Informacion del cliente", 0, 1, "C", false);
      $this->pdf->SetTextColor(0,0,0);
      $this->pdf->SetFont("Arial","",12);
      $this->pdf->Cell(0, 8, "DNI: " . $cliente->getDni(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Nombre: " . $cliente->getNombre(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Apellidos: " . $cliente->getApellidos(), "L", 1 ,"L", false);
      $this->pdf->Cell(0, 8, "Email: " . $cliente->getEmail(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, $tel . ": " . $cliente->getTelefono(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, $dir . ": " . $cliente->getDireccion(), "L", 1, "L", false);

      $this->pdf->Ln();
      $this->pdf->SetTextColor(183,28,28);
      $this->pdf->SetFont("Arial","",16);
      $this->pdf->Cell(0, 10, "Informacion del coche", 0, 1, "C", false);
      $this->pdf->SetTextColor(0,0,0);
      $this->pdf->SetFont("Arial","",12);
      $this->pdf->Cell(0, 8, "Matricula: " . $vehiculo->getId(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Marca: " . $vehiculo->getMarca(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Tipo: " . $vehiculo->getTipo(), "L", 1, "L", false);

      $this->pdf->Ln();
      $this->pdf->SetTextColor(183,28,28);
      $this->pdf->SetFont("Arial","",16);
      $this->pdf->Cell(0, 10, "Informacion del pago", 0, 1, "C", false);
      $this->pdf->SetTextColor(0,0,0);
      $this->pdf->SetFont("Arial","",12);
      $this->pdf->Cell(0, 8, "ID: " . $pago->getId(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Hora: " . $pago->getHora(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Fecha: " . $pago->getFecha(), "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Precio: " . $pago->getCosto() . EURO, "L", 1, "L", false);

      $this->pdf->Ln();
      $this->pdf->SetTextColor(183,28,28);
      $this->pdf->SetFont("Arial","",16);
      $this->pdf->Cell(0, 10, "Informacion del ITV", 0, 1, "C", false);
      $this->pdf->SetTextColor(0,0,0);
      $this->pdf->SetFont("Arial","",12);
      $this->pdf->Cell(0, 8, "Estato exterior: Bien", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Estado inferior: Bien", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, $alumbrado . ": Bien: ", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Claxon: Bien", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Frenos: Bien", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, $analisis . ": Bien", "L", 1, "L", false);
      $this->pdf->Cell(0, 8, "Total: BIEN", "L", 1, "L", false);

      $this->pdf->SetY(-40);
      $this->pdf->SetTextColor(183,28,28);
      $this->pdf->SetFont("Arial","",14);
      $this->pdf->Cell(0, 8, "ITV", "R", 1, "R", false);
      $this->pdf->Cell(0, 8, "Autor: Ivan Savchyn", "R", 1, "R", false);




      $nomb = "ITV" . $vehiculo->getId() . ".pdf";
      $this->nomb_archivo = $nomb;
      $this->pdf->Output("F",$nomb);
      rename($nomb, "../ArchivosPDF/".$nomb);
    }

  }
?>
