<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require_once APPPATH . 'controllers/proktor/Home_proktor.php';
require FCPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cetak extends Home_proktor{
	function index(){
    $sql = 'SELECT ujian_id, judul, status_soal, mulai, selesai, jml_soal
    FROM ujian ORDER BY mulai DESC';
    $this->load->view('proktor/cetak/index', $data);
  }
  
  function kartu_peserta(){
    $ujian_id = $_GET['ujian_id'];
    $sql = "SELECT nis, login, password, server, nama FROM peserta WHERE ujian_id = '$ujian_id'
            ORDER BY nis ";
    $data = $this->db->query($sql)->result();
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getColumnDimension('E')->setWidth(12);

    // Border untuk judul
    $this->__atur_border($sheet, 'A2:I8');
    $this->__atur_border($sheet, 'B3:C7');
    $sheet->setCellValue('E3', 'DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA');
    $sheet->setCellValue('E4', 'KOTA PROBOLINGGO');
    $sheet->setCellValue('E5', 'KARTU UJIAN ...');
    
    $baris_awal = 9;
    $baris_terakhir = 9 + 6;
    foreach($data as $r){
      $this->__atur_border($sheet, "A$baris_awal:I$baris_terakhir");
      $this->__atur_border($sheet, 'B' . ($baris_awal + 1) . ':C' . ($baris_awal + 5));
      $sheet->setCellValue('E' . ($baris_awal + 1), 'USER');
      $sheet->setCellValue('F' . ($baris_awal + 1), $r->login);
      $sheet->setCellValue('E' . ($baris_awal + 2), 'PASSWORD');
      $sheet->setCellValue('F' . ($baris_awal + 2), $r->password);
      $sheet->setCellValue('E' . ($baris_awal + 3), 'SERVER');
      $sheet->setCellValue('F' . ($baris_awal + 3), $r->server);
      $sheet->setCellValue('E' . ($baris_awal + 4), 'NISN');
      $sheet->setCellValue('F' . ($baris_awal + 4), $r->nis);
      $sheet->setCellValue('E' . ($baris_awal + 5), 'NAMA');
      $sheet->setCellValue('F' . ($baris_awal + 5), $r->nama);

      $tambahan = ($baris_terakhir % 43 == 0) ? 6 : 1;
      $baris_awal = $baris_terakhir + $tambahan;
      $baris_terakhir = $baris_awal + 6;
    }
    
    $writer = new Xlsx($spreadsheet);
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=kartu_peserta_$ujian_id.xlsx");
    $writer->save('php://output');
    
  }

  private function __atur_border($sheet, $area){
    $styleArray = [
      'borders' => [
          'outline' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
              'color' => ['argb' => '000'],
          ],
      ],
    ];
    $sheet->getStyle($area)->applyFromArray($styleArray);
  }
}