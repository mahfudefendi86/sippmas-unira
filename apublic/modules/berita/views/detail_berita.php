<button class="btn btn-warning float-md-right" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</button><br/>
<?php
if(isset($berita)){
?>
<span class="header_berita"><?php echo $berita->judul;?></span>
<div class="content clearfix mt-1 p-2">
    <?php echo $berita->isi_berita;?>
</div>
<div>
    <span class="widget_sm" ><i class="fa fa-calendar"></i> <?php echo tgl_indo($berita->tanggal);?></span>
    <span class="widget_sm" ><i class="fa fa-clock-o"></i> <?php echo $berita->jam;?></span>
    <span class="widget_sm" ><i class="fa fa-user"></i> by <?php echo $berita->nama_user;?></span>
</div>

<?php }; ?>
