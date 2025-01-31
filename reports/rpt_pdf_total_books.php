<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/books/config/global.php");
require_once(ROOT_DIR . "/model/Ven_booksModel.php");
include(ROOT_CORE . "/fpdf/fpdf.php");

class PDF extends FPDF
{
    function convertxt($p_txt)
    {
        return iconv('UTF-8', 'iso-8859-1', $p_txt);
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Book Report', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->setFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->convertxt("Pagina") . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$filter = isset($_GET['filter']) ? urldecode(trim($_GET['filter'])) : '';

$rpt = new Ven_booksModel();
$records = $rpt->findFiltered($filter); 
$records = $records['DATA'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // Añadir página en orientación horizontal

// Cabecera
$pdf->SetFont('Arial', 'B', 7);
$header = array(
    $pdf->convertxt("ID"),
    $pdf->convertxt("Title"),
    $pdf->convertxt("Author"),
    $pdf->convertxt("Genre"),
    $pdf->convertxt("Publication date"),
    $pdf->convertxt("Count Pages"),
    $pdf->convertxt("Editor"),
    $pdf->convertxt("ISBN"),
    $pdf->convertxt("Language"),
    $pdf->convertxt("Bestseller"),
    $pdf->convertxt("Edition"),
    $pdf->convertxt("Traslated"),
    $pdf->convertxt("Legal Dep number")
);
$widths = array(6, 40, 26, 21, 25, 18, 45, 18, 16, 15, 12, 15, 24);
for ($i = 0; $i < count($header); $i++) {
    $pdf->Cell($widths[$i], 7, $header[$i], 1);
}
$pdf->Ln();

// Cuerpo
$pdf->SetFont('Arial', '', 6);
foreach ($records as $record) {
    $pdf->Cell($widths[0], 6, $pdf->convertxt($record['book_id']), 1);
    $pdf->Cell($widths[1], 6, $pdf->convertxt($record['title']), 1);
    $pdf->Cell($widths[2], 6, $pdf->convertxt($record['author']), 1);
    $pdf->Cell($widths[3], 6, $pdf->convertxt($record['genre']), 1);
    $pdf->Cell($widths[4], 6, $pdf->convertxt($record['publication_date']), 1);
    $pdf->Cell($widths[5], 6, $pdf->convertxt($record['page_count']), 1);
    $pdf->Cell($widths[6], 6, $pdf->convertxt($record['publisher']), 1);
    $pdf->Cell($widths[7], 6, $pdf->convertxt($record['isbn']), 1);
    $pdf->Cell($widths[8], 6, $pdf->convertxt($record['original_language_book']), 1);
    $pdf->Cell($widths[9], 6, $pdf->convertxt($record['bestseller']), 1);
    $pdf->Cell($widths[10], 6, $pdf->convertxt($record['book_edition']), 1);
    $pdf->Cell($widths[11], 6, $pdf->convertxt($record['translated_book_language']), 1);
    $pdf->Cell($widths[12], 6, $pdf->convertxt($record['legal_deposit_number']), 1);
    $pdf->Ln();
}

$pdf->Output();
?>
