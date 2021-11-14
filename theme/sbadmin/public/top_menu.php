<div class="container mb-3" style="margin-top:4rem;">
    <div class="row">
        <div class="col-md-9 col-lg-9">
            <?php if(isset($berita)){ ;?>
            <span class="mr-1 ml-2 ketagori_berita_lg" style="background:<?php echo $berita->warna;?>;"><i class="<?php echo $berita->ikon;?>"></i> <?php echo $berita->kategori;?></span>
        <?php }; ?>
            <a class="text-secondary float-md-right" style="cursor:pointer;" onclick="window.history.back();"><i class="fa fa-chevron-left back_button" ></i>Kembali</a>
        </div>
        <div class="col-md-3 col-lg-3">
            <!--  KSONG-->
        </div>
    </div>
</div>
