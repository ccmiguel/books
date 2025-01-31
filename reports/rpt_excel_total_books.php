<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/books/config/global.php");
require_once(ROOT_DIR . "/model/Ven_booksModel.php");
require_once(ROOT_DIR . "/vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener el filtro de la URL
$filter = isset($_GET['filter']) ? urldecode(trim($_GET['filter'])) : '';

// Obtener los registros
$rpt = new Ven_booksModel();
$records = $rpt->findFiltered($filter);
$records = $records['DATA'];

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer la cabecera
$header = array(
    "ID",
    "Title",
    "Author",
    "Genre",
    "Publication date",
    "Count Pages",
    "Editor",
    "ISBN",
    "Language",
    "Bestseller",
    "Edition",
    "Translated",
    "Legal Dep number"
);
$sheet->fromArray($header, NULL, 'A1');

// Establecer el estilo de la cabecera
$sheet->getStyle('A1:N1')->getFont()->setBold(true);
$sheet->getStyle('A1:N1')->getAlignment()->setHorizontal('center');

// Añadir los datos
$row = 2; // Comenzar en la segunda fila para los datos
foreach ($records as $record) {
    $sheet->setCellValue('A' . $row, $record['book_id']);
    $sheet->setCellValue('B' . $row, $record['title']);
    $sheet->setCellValue('C' . $row, $record['author']);
    $sheet->setCellValue('D' . $row, $record['genre']);
    $sheet->setCellValue('E' . $row, $record['publication_date']);
    $sheet->setCellValue('F' . $row, $record['page_count']);
    $sheet->setCellValue('G' . $row, $record['publisher']);
    $sheet->setCellValue('H' . $row, $record['isbn']);
    $sheet->setCellValue('I' . $row, $record['original_language_book']);
    $sheet->setCellValue('J' . $row, $record['bestseller']);
    $sheet->setCellValue('K' . $row, $record['book_edition']);
    $sheet->setCellValue('L' . $row, $record['translated_book_language']);
    $sheet->setCellValue('M' . $row, $record['legal_deposit_number']);
    $row++;
}

// Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$filePath = 'book_report.xlsx';
$writer->save($filePath);

// Enviar el archivo Excel al navegador para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filePath . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
