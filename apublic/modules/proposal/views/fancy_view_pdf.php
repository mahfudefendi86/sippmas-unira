<?php
if(isset($proposal)){
    $filepath = base_url().$proposal->file;
    //$filepath="https://www.unifg.it/sites/default/files/allegatiparagrafo/10-02-2014/alimi_clil_in_sociology_of_religion.pdf";
    // EDIT: I added some permission/file checking.
    // if (!file_exists($filepath)) {
    //     throw new Exception("File $filepath does not exist");
    // }
    // if (!is_readable($filepath)) {
    //     throw new Exception("File $filepath is not readable");
    // }
    // http_response_code(200);
    // header('Content-Length: '.filesize($filepath));
    // header("Content-Type: application/pdf");
    // //header('Content-Disposition: attachment; filename="downloaded.pdf"'); // feel free to change the suggested filename
    // readfile($filepath);

    echo '<iframe src="http://docs.google.com/gview?url='.$filepath.'&embedded=true" style="width:100%; height:560px" frameborder="0"></iframe>';
}

?>
