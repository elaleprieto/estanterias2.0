<?php

App::import('Lib', 'tcpdf/tcpdf');
# Cliente ID
define('CLIENTEID', $pedido['Cliente']['id']);
# Cliente
define('CLIENTE', $pedido['Cliente']['nombre']);
# Fecha de finalización del pedido
define('FECHA', date('d/m/Y', strtotime($pedido['Pedido']['created'])));
$fecha = date('Y-m-d H.i', strtotime($pedido['Pedido']['created']));

# Tamaño de una Página A4 común y silvestre
# ancho = 210 [mm]
# alto 	= 297 [mm]

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Seteo de la fuente
        $this->SetFont('freesans', 'B', 12);
        // Título
        $this->Cell(196/2, 10, 'Presupuesto para ' . CLIENTE, array('B' => 1), false, 'L', 0, '', 0, false, 'M', 'B');
        // $this->Cell(196/3, 10, 'Código: ' . CLIENTEID, array('B' => 1), false, 'R', 0, '', 0, false, 'M', 'B');
        $this->Cell(196/2, 10, 'Fecha: ' . FECHA, array('B' => 1), false, 'R', 0, '', 0, false, 'M', 'B');
    }
}



$tcpdf = new MYPDF();

$textfont = 'freesans';
$tcpdf -> SetCreator(PDF_CREATOR);
$tcpdf -> SetAuthor("ELEFE");
$tcpdf -> SetTitle("Presupuesto");
$tcpdf -> SetSubject("Presupuesto");
$tcpdf -> SetKeywords("Presupuesto");
$tcpdf -> SetPrintHeader(TRUE);
$tcpdf -> SetPrintFooter(TRUE);
$tcpdf -> SetImageScale(PDF_IMAGE_SCALE_RATIO);
$tcpdf -> AliasNbPages();

# Márgenes de la página
// $tcpdf -> SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$tcpdf -> SetAutoPageBreak(TRUE, 7);
// $tcpdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf -> SetMargins(7, 12, 7);
// $tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER); en milímetros
$tcpdf -> SetHeaderMargin(7);
// $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER); en milímetros
$tcpdf -> SetFooterMargin(7);

# Pie de Página
$tcpdf -> SetFooterFont(Array(
		PDF_FONT_NAME_DATA,
		'',
		PDF_FONT_SIZE_DATA
));
$tcpdf -> SetFooterMargin(7);

$tcpdf -> AddPage();

###############################################################
# Seteo de parámetros
###############################################################

# Tamaño y Tipo de Letra
$tcpdf -> SetFont("freesans", "B", 9);

# Ancho de celda (en milímetros)
$celda_ancho = 90;
// $celda_ancho_codigo = 9;
$celda_ancho_cantidad = 8;
$celda_ancho_unidad = 8;
$celda_ancho_detalle = 160;
$celda_ancho_precio = 20;
// $celda_ancho_observaciones = 25;
$fila_ancho_transporte = 171;
$celda_ancho_b = 5;
$celda_ancho_cobinpro = 20;
$datos_fila_transporte = 3;
$celda_ancho_transporte = $fila_ancho_transporte / $datos_fila_transporte;

# Alto de celda (en milímetros)
$celda_alto = 6;

###############################################################
# Fila de Transporte
###############################################################
# Cell ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

# Se imprime el Transporte
$tcpdf -> Cell($celda_ancho_transporte, $celda_alto, 'Transporte: ' . $pedido['Transporte']['nombre'], 0, 0, '');
# Se imprime la Cantidad de Artículos
$tcpdf -> Cell($celda_ancho_transporte, $celda_alto, 'Cantidad de Artículos: '. $pedido['Pedido']['articulos'], 0, 0, 'C');
# Si se envía Contrarrembolso, se imprime... si no, se imprime en blanco.
$pedido['Pedido']['contrarrembolso'] ? $tcpdf -> Cell($celda_ancho_transporte, $celda_alto, 'Contrarrembolso', 0, 0, 'C') : $tcpdf -> Cell($celda_ancho_transporte, $celda_alto, '', 0, 0, 'L');
# Si se envía Cobinpro, se imprime... si no, se imprime en blanco.
# Se imprime en blanco...
$pedido['Pedido']['cobinpro'] ? $tcpdf -> Cell($celda_ancho_cobinpro, $celda_alto, '', 0, 0, 'C') : $tcpdf -> Cell($celda_ancho_cobinpro, $celda_alto, '', 0, 0, 'L');

// if ($pedido['Pedido']['b']) {
	// $tcpdf -> Cell($celda_ancho_b, $celda_alto, '***', 0, 0, 'R');
// }
# Se imprime la celda que provoca el salto de línea
$tcpdf -> Cell(1, $celda_alto, '', 0, 1, '');

###############################################################
# Fila de Observaciones
###############################################################
# TCPDF::MultiCell($w, $h, $txt, $border=0,	$align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0,$valign='T', $fitcell=false)
// if ($pedido['Pedido']['observaciones']) {
	// $tcpdf -> Cell(0, $celda_alto, "Observaciones: ", array('LTR' => 1), 1);
// 
	// # Tamaño y Tipo de Letra
	// $tcpdf -> SetFont("freesans", "", 9);
// 
	// $tcpdf -> MultiCell(0, $celda_alto, $pedido['Pedido']['observaciones'], array('LR' => 1), 'L');
// 
	// # Tamaño y Tipo de Letra
	// $tcpdf -> SetFont("freesans", "B", 9);
// }

###############################################################
# Fila de títulos de columna
###############################################################
// $tcpdf -> Cell($celda_ancho_codigo, $celda_alto, '', 1, 0, 'C');
// $tcpdf -> Cell($celda_ancho_codigo, $celda_alto, 'Cód', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_cantidad, $celda_alto, 'Cant', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_unidad, $celda_alto, 'Unid', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_detalle, $celda_alto, 'Detalle', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_precio, $celda_alto, 'Precio Unit.', 1, 1, 'C');
// $tcpdf -> Cell($celda_ancho_observaciones, $celda_alto, 'Observaciones', 1, 1, 'C');

###############################################################
# Armo la lista
###############################################################

# Tamaño y Tipo de Letra
$tcpdf -> SetFont("freesans", "", 10);

$html = '<table cellspacing="0" cellpadding="1" border="0.7">';
foreach ($ordenes as $orden) {
	$html .= "<tr>"; 
	// if ($orden['Orden']["estado"]) {
		// $html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm" align="center">X</td>';
// 		
		// # Se verifica si el artículo se envía sin cargo.
		// if ($orden['Orden']["sin_cargo"]) {
			// $html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm" align="center"><font size="8">Sin Cargo</font></td>';
		// } else {
			// $html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm" align="center"><font size="9">'.$orden['Orden']["id"].'</font></td>';
		// }
	// } else {
		// $html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm" align="center">--</td>';
		// $html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm"></td>';
	// }
	$html .= '<td width="'.$celda_ancho_cantidad.'mm" height="'.$celda_alto.'mm" align="center">'.$orden['Orden']["cantidad_original"].'</td>';
	$html .= '<td width="'.$celda_ancho_unidad.'mm" height="'.$celda_alto.'mm" align="center"><font size="8">'.$orden['Orden']["articulo_unidad"].'</font></td>';
	$html .= '<td width="'.$celda_ancho_detalle.'mm" height="'.$celda_alto.'mm">'.$orden['Orden']["articulo_detalle"].'</td>';
	
	# Se imprime el Precio
	$html .= '<td width="'.$celda_ancho_precio.'mm" height="'.$celda_alto.'mm" align="center">$ '.$orden['Orden']["articulo_precio_venta"].'</td>';
	// $html .= '<td width="'.$celda_ancho_observaciones.'mm" height="'.$celda_alto.'mm"><font size="8">'.$orden['Orden']["observaciones"].'</font></td>';

	$html .= "</tr>";
}
$html .= '</table>';

// output the HTML content
$tcpdf -> writeHTML($html);

$tcpdf -> Output(CLIENTE . " - " . $fecha . ".pdf", "I");
?>