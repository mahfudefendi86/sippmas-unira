<?php
function generate_pdf(){
	require_once('tcpdf/tcpdf.php');

	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {
		//Page header
		public function Header() {
			//ambil data setting profil
			
		}

		// Page footer
		public function Footer() {
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		}
	}
}

function generate_pdf1(){
	require_once('tcpdf/tcpdf.php');

	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {
		//Page header
		public function Header() {
			//ambil data setting profil
			$ci = & get_instance();
            $ci->load->model('setting_model');
			$data= $ci->setting_model->get_setting();
			//$set=mysql_fetch_row(mysql_query($sql));

			// Logo
			$image_file = base_url().'asset/images/logo.jpg';
			$this->Image($image_file, 10, 5, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			/* Set font*/
			$this->SetFont('helvetica', 'B', 15);
			$this->SetXY(50, 5);
			$this->Cell(130, 10, $data->nama_usaha, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

			$this->SetFont('helvetica', '', 10);
			$this->SetXY(50, 15);
			$this->Cell(0, 0, $data->alamat_usaha, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

			$this->SetFont('helvetica', '', 10);
			$this->SetXY(50, 20);
			$this->Cell(0, 0,'Telp. '.$data->telepon_usaha.' / '.$data->hp_usaha, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

			//create LINE
			$style1 = array('width' => 0.4, 'color' => array(0, 0, 0));
			$this->Line(10, 27, 287, 27, $style1);
			$style2 = array('width' => 0.2, 'color' => array(0, 0, 0));
			$this->Line(10, 27.7, 287, 27.7, $style2);

		}

		// Page footer
		public function Footer() {
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().' / '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		}
	}
}



?>
