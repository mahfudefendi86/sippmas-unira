<?php if(isset($status)){ ;?>
<div class="card">
    <div class="card-body">
        <h3 class="text-primary">INFO STATUS PENGAJUAN HIBAH INTERNAL</h3><br/>
        <div class="alert alert-danger"><span class="text-danger h5">Maaf, anda saat ini belum dapat mengajukan judul penelitian atau pengabdian Hibah Internal</span></div>
        <br/>
        <p>Status anda saat ini adalah:</p>
        <?php if($status->aktif_kembali=="N"){ ;?>
            <h4><span class="badge badge-danger">NON AKTIF</span></h4>
        <?php }else{ ;?>
            <h4><span class="badge badge-success">AKTIF</span></h4>
        <?php };?>
        <br/>
        <p>Alasan:<br/>
            <div class="alert alert-info"><?php echo $status->alasan_nonaktif ;?></div>
        </p>
    </div>
</div>
<?php }else{ echo "Maaf, bukan hak akses anda..."; };?>
