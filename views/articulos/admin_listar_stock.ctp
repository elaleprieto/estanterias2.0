<?php
# Tamaño de una Página A4 común y silvestre
# ancho = 210 [mm]
# alto 	= 297 [mm]

App::import('Lib', 'tcpdf/tcpdf');
$tcpdf = new TCPDF();

$textfont = 'freesans';
$tcpdf -> SetCreator(PDF_CREATOR);
$tcpdf -> SetAuthor("autor");
$tcpdf -> SetTitle("Título");
$tcpdf -> SetSubject("Tutorial TCPDF en cakePHP");
$tcpdf -> SetKeywords("TCPDF, PDF, cakePHP, ejemplo");
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

/*	if(file_exists(K_PATH_IMAGES . 'alpha.png')) {
 echo "The file exists";
 } else {
 echo "The file does not exist";
 }
 */
# 	Image ($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array())
// $tcpdf -> Image(K_PATH_IMAGES . 'logo.gif', 15, 15, 0, 0, 'GIF');

# Encabezado de Página
$tcpdf -> SetHeaderData("", "", "Listado de Stock", "");
$tcpdf -> SetHeaderFont(Array(
		PDF_FONT_NAME_MAIN,
		'',
		PDF_FONT_SIZE_MAIN
));

# Pie de Página
$tcpdf -> SetFooterFont(Array(
		PDF_FONT_NAME_DATA,
		'',
		PDF_FONT_SIZE_DATA
));
$tcpdf -> SetFooterMargin(7);

$tcpdf -> AddPage();

# Titulo
// $tcpdf -> SetFont("freesans", "B", 20);
// $tcpdf -> Cell(0, 15, "Pedido de " . $pedido['Cliente']['nombre'], 0, 1, 'C');

###############################################################
# Seteo de parámetros
###############################################################

# Tamaño y Tipo de Letra
$tcpdf -> SetFont("freesans", "B", 9);

# Ancho de celda (en milímetros)
$celda_ancho = 90;
$celda_ancho_codigo = 11;
$celda_ancho_cantidad = 10;
$celda_ancho_unidad = 10;
$celda_ancho_detalle = 165;

# Alto de celda (en milímetros)
$celda_alto = 6;


###############################################################
# Fila de títulos de columna
###############################################################
$tcpdf -> Cell($celda_ancho_codigo, $celda_alto, 'Cód', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_cantidad, $celda_alto, 'Stock', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_unidad, $celda_alto, 'Unid', 1, 0, 'C');
$tcpdf -> Cell($celda_ancho_detalle, $celda_alto, 'Detalle', 1, 1, 'C');

###############################################################
# Armo la lista
###############################################################

# Tamaño y Tipo de Letra
$tcpdf -> SetFont("freesans", "", 10);

$html = '<table cellspacing="0" cellpadding="1" border="0.7">';
foreach ($articulos as $key => $articulo) {
	$html .= "<tr>"; 
	$html .= '<td width="'.$celda_ancho_codigo.'mm" height="'.$celda_alto.'mm" align="center">'.$articulo["Articulo"]["id"].'</td>';
	$html .= '<td width="'.$celda_ancho_cantidad.'mm" height="'.$celda_alto.'mm" align="center">'.$articulo["Articulo"]["stock"].'</td>';
	$html .= '<td width="'.$celda_ancho_unidad.'mm" height="'.$celda_alto.'mm" align="center">'.$articulo["Articulo"]["unidad"].'</td>';
	$html .= '<td width="'.$celda_ancho_detalle.'mm" height="'.$celda_alto.'mm">'.$articulo["Articulo"]["detalle"].'</td>';
	$html .= "</tr>";
}
$html .= '</table>';

// output the HTML content
$tcpdf -> writeHTML($html);

$fecha = date('Y-m-d H.i');

$tcpdf -> Output('Listado de Stock' . " - " . $fecha . ".pdf", "I");
?>