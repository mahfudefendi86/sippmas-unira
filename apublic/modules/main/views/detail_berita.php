<?php
if(isset($berita)){
?>
<div class="card mb-3">
    <div class="card-body">
        <div>
            <span class="header_berita"><?php echo $berita->judul;?></span>
            <div class="content clearfix mt-1 p-2">
                <?php echo $berita->isi_berita;?>
            </div>
                <div>
                    <span class="widget_sm" ><i class="fa fa-calendar"></i> <?php echo tgl_indo($berita->tanggal);?></span>
                    <span class="widget_sm" ><i class="fa fa-clock-o"></i> <?php echo $berita->jam;?></span>
                    <span class="widget_sm" ><i class="fa fa-user"></i> by <?php echo $berita->nama_user;?></span>
                </div>
        </div>
	</div>
</div>
<?php }; ?>
