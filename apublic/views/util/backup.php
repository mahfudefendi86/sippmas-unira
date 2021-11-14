<script type="text/javascript">
$(document).ready(function() {

	$("#bak").click(function(){
		 $.ajax({
					url: "<?php echo site_url('util/proses_backup') ;?>",
					type: "POST",
					dataType: "html",
					data: '',
					beforeSend: function(){
						$("#loader").fadeIn(100);
					},
					success: function(data){
						$("#loader").fadeOut(100);
						$("#download").fadeIn(500);
						$("#url_do").attr('href','<?php echo site_url('util/download_file');?>/'+data);
					}
			});///akhir dari ajax
				
    });	

	
});
</script>
<fieldset>
<legend>Backup Utility</legend>
<div align="center">
<h3>Silahkan tekan tombol "Proses Backup" untuk melakukan Backup Database. <br/>Waktu yang dibutuhkan untuk proses backup tergantung dari banyak nya data.<br />
</h3>
<input type="button" name="bakup" id="bak" value="  Proses Backup  " class="btn btn-primary btn-lg" />
<div class="text-center"><img src="<?php echo base_url();?>asset/images/ajax-loader.gif" border="0" align="absmiddle" alt="Loader" style="display:none" id="loader" /></div>

</div>
<br />
<br />
<div id="download" class="text-center" style="height:128px; width:250px; margin:auto; display:none;">
<a id="url_do" href="" class="btn btn-lg btn-warning" title="DOWNLOAD"><span class="glyphicon glyphicon-save"></span> Download</a>
</div><br />
<br />

</fieldset>
<div id="dialog" title="Konfirmasi" style="display:none;">
   <p>Apakah Anda yakin ingin menghapus data?</p>
</div>