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
$tcpdf -> SetSubject("Etiquetas Mini");
$tcpdf -> SetKeywords("Etiquetas, Mini");
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

# Tamaño y Tipo de Letra
$tcpdf -> SetFont("freesans");

# Margenes (en milímetros)
$margen_izquierdo = 5;
$margen_derecho = 5;
$margen_superior = 5;
$margen_inferior = 5;

# Seteo de márgenes iniciales
$x = $margen_izquierdo;
$y = $margen_superior;

# Ancho de celda (en milímetros)
$celda_ancho_total = 52.5;
$celda_ancho = $celda_ancho_total - $margen_izquierdo - $margen_derecho;

# Alto de celda (en milímetros)
$celda_alto_total = 21;
$celda_alto = $celda_alto_total - $margen_superior - $margen_inferior;

###############################################################
# Definición de variables
###############################################################

$cantidadEtiquetas = $this -> data['Articulos']['etiquetas'] ? $this -> data['Articulos']['etiquetas'] : 1;
$etiquetasPorPagina = 56;
$cantidadPaginas = ceil($cantidadEtiquetas / $etiquetasPorPagina);
$etiquetasHechas = 0;
$etiquetasEnBlanco = $this -> data['Articulos']['inicio'] ? $this -> data['Articulos']['inicio'] : 0;
if ($etiquetasEnBlanco > 0) {
	$etiquetasEnBlanco--;
}
$etiquetasHechas = $etiquetasEnBlanco;

###############################################################
# Inicialización
###############################################################

# desplazamiento hacia abajo, dejando etiquetas en blanco arriba
$etiquetasEnBlancoFila = floor($etiquetasEnBlanco / 4);
if ($etiquetasEnBlancoFila >= 1) {
	$y = $y + $celda_alto_total * $etiquetasEnBlancoFila;
}

# desplazamiento hacia la derecha
$cantEtiqEnBlancoCol = $etiquetasEnBlanco % 4;
$x = $x + $celda_ancho_total * $cantEtiqEnBlancoCol;

###############################################################
# Fila de Detalle
###############################################################
# Cell ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
# TCPDF::MultiCell($w, $h, $txt, $border=0,	$align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false)

while ($cantidadEtiquetas > 0) {
	if ($etiquetasHechas >= $etiquetasPorPagina) {
		$tcpdf -> AddPage();
		$etiquetasHechas = 0;
		$x = $margen_izquierdo;
		$y = $margen_superior;
	}
	$tcpdf -> MultiCell($celda_ancho, $celda_alto / 2, $this -> data['Articulos']['detalle'], 0, 'C', FALSE, 1, $x, $y, TRUE, 0, FALSE, TRUE, $celda_alto / 2, 'M', TRUE);
	$tcpdf -> MultiCell($celda_ancho, $celda_alto / 2, $this -> data['Articulos']['unidades'] . ' ' . $this -> data['Articulos']['unidad'], 0, 'C', FALSE, 1, $x, '', TRUE, 0, FALSE, TRUE, $celda_alto / 2, 'B', TRUE);

	if ($x > $celda_ancho_total * 3) {
		$x = $margen_izquierdo;
		$y = $y + $celda_alto_total;
	} else {
		$x = $x + $celda_ancho_total;
	}

	$cantidadEtiquetas--;
	$etiquetasHechas++;
}

$tcpdf -> Output("Etiquetas Mini - " . $this -> data['Articulos']['detalle'] . ".pdf", "I");
?>