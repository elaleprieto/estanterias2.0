<?php
# Tamaño de una Página A4 común y silvestre
# ancho = 210 [mm]
# alto 	= 294 [mm]

App::import('Lib', 'tcpdf/tcpdf');
$tcpdf = new TCPDF();

$textfont = 'freesans';
$tcpdf -> SetCreator(PDF_CREATOR);
$tcpdf -> SetAuthor("Ale Prieto");
$tcpdf -> SetTitle("Etiquetas");
$tcpdf -> SetSubject("Etiquetas");
$tcpdf -> SetKeywords("Etiquetas");
$tcpdf -> SetPrintHeader(FALSE);
$tcpdf -> SetPrintFooter(FALSE);
$tcpdf -> AliasNbPages();

# Márgenes de la página
// $tcpdf -> SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$tcpdf -> SetAutoPageBreak(FALSE, 5);
// $tcpdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf -> SetMargins(0, 0, 0, 0);

$tcpdf -> AddPage();

# Titulo
// $tcpdf -> SetFont("freesans", "B", 20);
// $tcpdf -> Cell(0, 15, "Pedido de " . $pedido['Cliente']['nombre'], 0, 1, 'C');

###############################################################
# Seteo de parámetros
###############################################################

# Margenes (en milímetros)
$margen_izquierdo = 5;
$margen_derecho = 5;
$margen_superior = 5;
$margen_inferior = 5;

# Seteo de márgenes iniciales
$x = $margen_izquierdo;
$y = $margen_superior;

# Ancho de celda (en milímetros)
# surge de hacer 105 es el ancho de la etiqueta, menos 5 margen izq, menos 5 margen der,
# para que sean simétricos...
$celda_ancho_total = 105;
$celda_ancho = $celda_ancho_total - $margen_izquierdo - $margen_derecho;

# Alto de celda (en milímetros)
# 49.46 es el alto de la etiqueta
$celda_alto_total = 49.46;
$celda_alto = $celda_alto_total - $margen_superior - $margen_inferior;

###############################################################
# Definición de variables
###############################################################

$cantidadEtiquetas = $this -> data['Clientes']['etiquetas'] ? $this -> data['Clientes']['etiquetas'] : 1;
$etiquetasPorPagina = 12;
$cantidadPaginas = ceil($cantidadEtiquetas / $etiquetasPorPagina);
$etiquetasHechas = 0;
$etiquetasEnBlanco = $this -> data['Clientes']['inicio'] ? $this -> data['Clientes']['inicio'] : 0;
if ($etiquetasEnBlanco > 0) {
	$etiquetasEnBlanco--;
}
$etiquetasHechas = $etiquetasEnBlanco;

###############################################################
# Inicialización
###############################################################

# desplazamiento hacia abajo, dejando etiquetas en blanco arriba
# 2 es el número de etiquetas por fila
$etiquetasEnBlancoFila = floor($etiquetasEnBlanco / 2);
if ($etiquetasEnBlancoFila >= 1) {
	$y = $y + $celda_alto_total * $etiquetasEnBlancoFila;
}

# desplazamiento hacia la derecha
# 2 es el número de etiquetas por fila
$cantEtiqEnBlancoCol = $etiquetasEnBlanco % 2;
$x = $x + $celda_ancho_total * $cantEtiqEnBlancoCol;

###############################################################
# Fila de Nombre
###############################################################
# Cell ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
# MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)

while ($cantidadEtiquetas > 0) {
	if ($etiquetasHechas >= $etiquetasPorPagina) {
		$tcpdf -> AddPage();
		$etiquetasHechas = 0;
		$x = $margen_izquierdo;
		$y = $margen_superior;
	}
	# Tamaño y Tipo de Letra
	$tcpdf -> SetFont("freesans", "B", 24);
	
	# 5 es el número de celdas: nombre * 2, dirección, localidad, provincia.
	$tcpdf -> MultiCell($celda_ancho, $celda_alto / 5 * 2, $this -> data['Clientes']['nombre'], 1, 'C', FALSE, 1, $x, $y, TRUE, 0, FALSE, TRUE, $celda_alto / 5 * 2, 'M', TRUE);
	$tcpdf -> SetFont("freesans", '', 12);
	$tcpdf -> MultiCell($celda_ancho * 2/3, $celda_alto / 5, $this -> data['Clientes']['direccion'], 1, 'L', FALSE, 0, $x, '', TRUE, 0, FALSE, TRUE, $celda_alto / 5, 'M', TRUE);
	$tcpdf -> SetFont("freesans", 'UI', 12);
	$tcpdf -> MultiCell($celda_ancho * 1/3, $celda_alto / 5, 'Bultos', array('R'=>1), 'C', FALSE, 1, $x + $celda_ancho * 2/3, '', TRUE, 0, FALSE, TRUE, $celda_alto / 5, 'M', TRUE);
	$tcpdf -> SetFont("freesans", "B", 16);
	$tcpdf -> MultiCell($celda_ancho * 2/3, $celda_alto / 5, $this -> data['Clientes']['localidad'], array('RL'=>1), 'L', FALSE, 0, $x, '', TRUE, 0, FALSE, TRUE, $celda_alto / 5, 'M', TRUE);
	$tcpdf -> SetFontSize(40);
	$tcpdf -> MultiCell($celda_ancho * 1/3, $celda_alto / 5 * 2, $this -> data['Clientes']['bultos'], array('BR'=>1), 'C', FALSE, 0, $x + $celda_ancho * 2/3, '', TRUE, 0, FALSE, FALSE, $celda_alto / 5 * 2, 'M', TRUE);
	$tcpdf -> SetFontSize(16);
	$tcpdf -> MultiCell($celda_ancho * 2/3, $celda_alto / 5, $this -> data['Clientes']['provincia'], array('BRL'=>1), 'L', FALSE, 1, $x, $y + $celda_alto / 5 * 4, TRUE, 0, FALSE, TRUE, $celda_alto / 5, 'M', TRUE);

	if ($x > $celda_ancho_total) {
		$x = $margen_izquierdo;
		$y = $y + $celda_alto_total;
	} else {
		$x = $x + $celda_ancho_total;
	}

	$cantidadEtiquetas--;
	$etiquetasHechas++;
}

$tcpdf -> Output("Etiquetas - " . $this -> data['Clientes']['nombre'] . ".pdf", "I");
?>