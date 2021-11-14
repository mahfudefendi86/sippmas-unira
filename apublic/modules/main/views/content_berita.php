<?php
if(isset($berita)){
    if(count($berita)>0){
        foreach($berita as $dataview){
;?>
<div class="widget_header">
    <a style="text-decoration:none;" href="<?php echo site_url('main/link/'.$dataview->id_kategori);?>"><span class="mr-1 ketagori_berita_lg" style="background:<?php echo $dataview->warna;?>;"><i class="<?php echo $dataview->ikon;?>"></i> <?php echo $dataview->kategori;?></span></a>
</div>
<div class="berita">
    <a href="<?php echo site_url('main/detail/'.$dataview->id_berita);?>" class="header_berita"><?php echo $dataview->judul;?></a>
    <div class="clearfix mt-2">
        <?php echo $dataview->isi_berita;?>
    </div>
    <div class="bottom_shade">
        <div class="widget">
            <span class="widget_sm" ><i class="fa fa-calendar"></i> <?php echo tgl_indo($dataview->tanggal);?></span>
            <span class="widget_sm" ><i class="fa fa-clock-o"></i> <?php echo $dataview->jam;?></span>
            <span class="widget_sm" ><i class="fa fa-user"></i> by <?php echo $dataview->nama_user;?></span>
            <a href="<?php echo site_url('main/detail/'.$dataview->id_berita);?>"  class="float-md-right readmore" > ... Selengkapnya <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>
<?php
        };
    }else{
        echo '<div class="alert alert-danger">Maaf, tidak ditemukan data...</div>';
    }
?>
<div  id="link_pagination" class="mt-3 float-md-right"><?php echo $links?></div>
<script>
$("#link_pagination ul a").click(function(){
    var link=$(this).attr("href");
    reload_data(link);
    return false;
})
</script>
<?php
    };
?>
