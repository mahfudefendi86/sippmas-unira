<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol> -->
  <div class="carousel-inner">
     <?php if(isset($slideshow)){
           if(count($slideshow)>0){
               $n=0;
               foreach ($slideshow as $dataview) {
                   if($n==0){
                       echo '<div class="carousel-item active">';
                   }else{
                       echo '<div class="carousel-item">';
                   }
                       echo '<img class="gambar" src="'.base_url().$dataview->gambar.'" alt="'.$dataview->judul_slide.'">';
                       echo '<div class="container" style="background:rgb(254, 134, 212)!important;">';
                       if(($dataview->judul_slide!="" || $dataview->judul_slide!=NULL) || ($dataview->deskripsi!="" || $dataview->deskripsi!=NULL)){
                           echo     '<div class="carousel-caption text-left">';
                               echo     '<h1>'.$dataview->judul_slide.'</h1>';
                               echo     ($dataview->deskripsi=="" || $dataview->deskripsi==NULL)?"":'<p class="slideshow_deskripsi">'.$dataview->deskripsi.'</p>';
                               if($dataview->link!="" || $dataview->link!=NULL){
                           			if (strpos($dataview->link, "http://") !== false || strpos($dataview->link, "https://") !== false) {
                                        echo '<p><a target="'.$dataview->target_link.'" class="btn btn-primary" href="'.$dataview->link.'" title="Baca lebh lanjut" role="button"><i class="fa fa-link"></i> Read more</a></p>';
                           			}else{
                           				echo '<p><a target="'.$dataview->target_link.'" class="btn btn-primary" href="http://'.$dataview->link.'" title="Baca lebh lanjut" role="button"><i class="fa fa-link"></i> Read more</a></p>';
                           			}
                           		}
                           echo     '</div>';
                       };
                       echo '</div>
                        </div>';
                    $n++;
               }
           }
     };?>

  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
