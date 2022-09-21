<?php
require('fpdf\fpdf.php');

$conectar=mysqli_connect('localhost','root','')
 or die("Error en la conexión ");
 
 mysqli_select_db($conectar, 'dbcapitansystem')
 or die("error al seleccionar la base de datos");

class PDF extends FPDF
{
// Cabecera de p�gina
function Header()
{
	// Logo
	$this->Image('IMAGE\cs.jpg',4,5,18);
	// Arial bold 15
	$this->SetFont('Arial','B',10);
	// Movernos a la derecha
	$this->Cell(80);
	// T�tulo
	$this->Cell(80,10,'REPORTE COMPONENTES - CAPYTAN SYSTEM',1,0,'C');
	// Salto de l�nea
	$this->Ln(20);
}

// Pie de p�gina
function Footer()
{
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$sql="SELECT*FROM `componentes`";
$result=mysqli_query($conectar,$sql)
    or die ("error en la consulta de insercion");

    $pdf->Cell(15,12,'idcom',1,0,'C');
    $pdf->Cell(45,12,'Marca',1,0,'C');
    $pdf->Cell(45,12,'Modelo',1,0,'C');
    $pdf->Cell(35,12,'Serie',1,0,'C');
    $pdf->Cell(30,12,'Cantidad',1,0,'C');
	$pdf->Cell(30,12,'Precio',1,0,'C');
   
for($i=1;$i<=40;$i++)
while($lista=mysqli_fetch_array($result)){

  
    
    $pdf->Ln();
    
    //$pdf->Cell(100,20,$lista[0]." ".$lista[1]." ".$lista[2]." ".$lista[3]." ".$lista[4]." ".$lista[5],1,0,'C');
    $pdf->Cell(15,12,$lista[0],1,0,'C');
    $pdf->Cell(45,12,$lista[1],1,0,'C');
    $pdf->Cell(45,12,$lista[2],1,0,'C');
    $pdf->Cell(35,12,$lista[3],1,0,'C');
    $pdf->Cell(30,12,$lista[4],1,0,'C');
    $pdf->Cell(30,12,$lista[5],1,0,'C');
 }
$pdf->Output();


?>
