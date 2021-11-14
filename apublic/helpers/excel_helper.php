<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__).'/PHPExcel.php');
require_once(dirname(__FILE__).'/PHPExcel/IOFactory.php');

if ( ! function_exists('expToexcel'))
{
 function expToexcel($data){
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set("Asia/Jakarta");
   $abjad=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
   /* format Setting array */
   $styleArray = array(
      	'font' => array(
      		'bold' => true,
      	),
      	'alignment' => array(
      		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
          'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      	),
      	'borders' => array(
      		'bottom' => array(
      			'style' => PHPExcel_Style_Border::BORDER_THIN,
      		),
      	),
      	'fill' => array(
          'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
      		'rotation' => 90,
      		'startcolor' => array(
      			'argb' => 'FFD5D5D5',
      		),
      		'endcolor' => array(
      			'argb' => 'FFFFFFFF',
      		),

      	),
    );

    $styleTitle= array(
      'font'  => array(
          'bold'  => true,
          'color' => array('rgb' => 'FF0000'),
          'size'  => 15,
          'name'  => 'Verdana'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
    );

    $styleSubTitle= array(
      'font'  => array(
          'bold'  => true,
          'color' => array('rgb' => '0000FF'),
          'size'  => 10,
          'name'  => 'Verdana'
      ),
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
    );

    $styleContent = array(
       	'font' => array(
          'size'  => 10,
          'name'  => 'Verdana'
       	),
       	'alignment' => array(
           'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
       	)
     );

    $object = new PHPExcel();
    $object->setActiveSheetIndex(0);
    /* setting Properties File Excel */
    $object->getProperties()->setCreator("tanpangantri.com")
                            ->setLastModifiedBy("admin_tanpangantri")
                            ->setTitle("Laporan Tanpangantri")
                            ->setSubject("Laporan Excel Tanpangantri")
                            ->setKeywords("tanpangantri");
    $object->getActiveSheet()->getPageSetup()->setHorizontalCentered(true)
                                             ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
                                             ->setFitToWidth(1)
                                             ->setFitToHeight(0);
    if($data['orientasi']=="Potrait"){
      $object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_DEFAULT);
    }else{
      $object->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    }

    /*mengatur Batas atas, kanan, kiri dan bawah halaman */
    $object->getActiveSheet()->getPageMargins() ->setTop(0.5)
                                                ->setRight(0.3)
                                                ->setLeft(0.3)
                                                ->setBottom(0.5);
    $object->getActiveSheet()->setShowGridLines(false);
    /*menambahkan gambar logo pada  excel */
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo Tanpangantri');
    $objDrawing->setDescription('Logo Tanpangantri');
    $objDrawing->setPath('./asset/images/logo.png',true);
    $objDrawing->setWidth(150);
    $objDrawing->setResizeProportional(true);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWorksheet($object->getActiveSheet());
    /* end object gambar */

    /*membuat Tittle dengan merger Cell */
    $numCol=count($data['field']);
    $object->getActiveSheet()->mergeCells('A2:'.$abjad[$numCol].'2');
    $object->getActiveSheet()->setCellValue('A2', $data['title']);
    $object->getActiveSheet()->getStyle('A2')->applyFromArray($styleTitle);
    /*membuat  subtitle dengan merger Cell */
    $object->getActiveSheet()->mergeCells('A3:'.$abjad[$numCol].'3');
    $object->getActiveSheet()->setCellValue('A3', $data['subtitle']);
    $object->getActiveSheet()->getStyle('A3')->applyFromArray($styleSubTitle);

    $object->getActiveSheet()->getRowDimension('5')->setRowHeight(25); /* mengatur tinggi baris */
    $object->getActiveSheet()->getStyle("A5")->applyFromArray($styleArray);/* penerapan format cell */
    $object->getActiveSheet()->setCellValueByColumnAndRow(0,5,"No"); /* membuat header nomer pada kolom index ke-0 */

    $column = 1; /* di mulai index ke-1 karena ke-0 untuk kolom nomer */
    /* membuat matriks HEADER */
    foreach($data['header'] as $Header)
    {
      if(isset($data['size'])){
        $object->getActiveSheet()->getColumnDimension($abjad[$column])->setWidth($data['size'][$column-1]); /* membuat lebar kolom sesuai setting*/
      }else{
        $object->getActiveSheet()->getColumnDimension($abjad[$column])->setAutoSize(true); /* membuat lebar kolom otomtais sesuai karakter*/
      }
     $object->getActiveSheet()->getStyle($abjad[$column]."5")->applyFromArray($styleArray);/* penerapan format cell */
     $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $Header);
     $column++;
    }

    /* membuat matriks content */
    $excel_row = 6; /*menentukan posisi baris pertama untuk mengisi content */
    $no=1;
    foreach($data['content'] as $row)
    {
      $object->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(18); /* mengatur tinggi baris */
      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);/* Membuat kolom nomer*/
      $object->getActiveSheet()->getColumnDimension("A")->setWidth(5); /* menentukan kolom nomer seleabr 5 */
      $object->getActiveSheet()->getStyle("A".$excel_row)->applyFromArray($styleContent);/*penerapan format */

      $excel_col=1;
      foreach ($data['field'] as $field) {
        /* Mengatur Lebar Kolom Sesuai Setting */
        if(isset($data['size'])){
          $object->getActiveSheet()->getColumnDimension($abjad[$excel_col])->setWidth($data['size'][$excel_col-1]); /* membuat lebar kolom sesuai setting*/
        }else{
          $object->getActiveSheet()->getColumnDimension($abjad[$excel_col])->setAutoSize(true); /* membuat lebar kolom otomtais sesuai karakter*/
        }

        /* mengisi data content cell dengan format */
        if($data['format'][$excel_col-1]=="string"){
          $object->getActiveSheet()->getCell($abjad[$excel_col].$excel_row)->setValueExplicit($row->$field, PHPExcel_Cell_DataType::TYPE_STRING);
        }else
        if($data['format'][$excel_col-1]=="numeric"){
          $object->getActiveSheet()->getCell($abjad[$excel_col].$excel_row)->setValueExplicit($row->$field, PHPExcel_Cell_DataType::TYPE_NUMERIC);
        }else{
          $object->getActiveSheet()->getCell($abjad[$excel_col].$excel_row)->setValueExplicit($row->$field, PHPExcel_Cell_DataType::TYPE_STRING);
        }

        $object->getActiveSheet()->getStyle($abjad[$excel_col].$excel_row)->applyFromArray($styleContent);/*penerapan format */
        $excel_col++;
      }
     $no++;
     $excel_row++;
    }
    // Rename worksheet
    $object->getActiveSheet()->setTitle(substr($data['title'],0,20));

      /* membuat file excel */
      // header('Content-Type: application/vnd.ms-excel');
      // header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
      // header('Cache-Control: private');
      // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
      // $object_writer->save('php://output');

    if($data['output']=="pdf"){
      //require_once(dirname(__FILE__).'/PHPExcel/Shared/PDF/config/tcpdf_config.php');
      $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
      $rendererLibraryPath = dirname(__FILE__).'/tcpdf';   // tcpdf folder
      if (!PHPExcel_Settings::setPdfRenderer(
      		$rendererName,
      		$rendererLibraryPath
      	)) {
      	die(
      		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
      		'<br />' .
      		'at the top of this script as appropriate for your directory structure'
      	);
      }

      /* membuat PDF dari excel */
      header('Content-Type: application/pdf');
      // header('Content-Disposition: attachment;filename="'.$filename.'.pdf"');
      // header('Cache-Control: max-age=0');
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'PDF');
       ob_end_clean();
      $filex=$data['path'].$data['title']."-".date('ymd').'.pdf';
    }else
    if($data['output']=="excel"){
       $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
       ob_end_clean();
       $filex=$data['path'].$data['title']."-".date('ymd').'.xlsx';
    }

     $object_writer->save($filex);
     return $filex;
  }
}
