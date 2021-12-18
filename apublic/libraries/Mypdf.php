<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mypdf {
	function pdf()
	{
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param=NULL)
	{
		if ($param == NULL)
		{
			$param = [
				'tempDir' => '/tmp',
				'mode'=>'utf-8',
				'autoArabic' => true,
				'format'=>'Folio',
				'orientation'=>'P',
				'margin_left'=>15,
				'margin_right'=>15,
				'margin-top'=>10,
				'margin-bottom'=>10] ;
		}
		return new \Mpdf\Mpdf($param);
	}

}
?>
