<fieldset>
<legend>Restore Utility</legend>
<div class="row clearfix">
	<div class="col-sm-2"></div>
    <div class="col-sm-8 text-center">
    <h3>Pilih File &quot;sql&quot; pada hardiks kemudian tekan tombol restore, untuk mengembalikan database</h3>
    <br />
	<br />

    <div class="alert_proc" id="alert" style="display:none;">Mohon Tunggu Sebentar....</div>
    <form method="post" enctype="multipart/form-data" action="<?php echo site_url('util/proses_restore');?>" onsubmit="document.getElementById('alert').style.display='block'">
    <input type="file" class="form-control" name="datafile" id="datafile" size="50"/><br />
<br />    
    <input type="submit" name="retore" id="rest" value="  Restore  " class="btn btn-primary btn-lg" />
    </form><br />

    <div class="alert alert-info"><strong>Peringatan :</strong><br/>Jika anda melakukan Restore Database, maka database yang ada saat ini akan <strong>di-Replace/diganti</strong> dengan database yang anda pilih untuk di Restore</div>
    </div>
  	<div class="col-sm-2"></div>
    <div id="download" class="clean-gray" style="height:128px; width:250px; margin:auto; display:none;">
    <a id="url_do" href="" title="DOWNLOAD"><img src="<?php echo base_url();?>asset/images/download.png" alt="Download" align="absmiddle" /> Download</a>
    </div>
</div>

</fieldset>
<div id="dialog" title="Konfirmasi" style="display:none;">
   <p>Apakah Anda yakin ingin menghapus data?</p>
</div>