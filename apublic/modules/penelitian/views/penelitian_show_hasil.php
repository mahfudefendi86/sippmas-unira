
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" >
<table class="table table-hover table-lg table-striped" id="tabel_penelitian">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="5">
		<?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ;?>
			<button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		<?php };?>
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th width="6%">No.</th>
	<th width="70%">Judul</th>
	<th width="12%">Thn Anggaran</th>
	<th width="20%">Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
if(count($penelitian)>0){
	foreach($penelitian as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_penelitian;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_penelitian;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_penelitian;?>" value="<?php echo $dataview->id_penelitian;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_penelitian;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td><?php

		if($dataview->status_pengajuan=="DISETUJUI"){
			$badge_bg="badge-success";
		}else
		if($dataview->status_pengajuan=="DITOLAK"){
			$badge_bg="badge-danger";
		}else
		if($dataview->status_pengajuan=="REVISI"){
			$badge_bg="badge-warning";
		}else
		if($dataview->status_pengajuan=="PENGAJUAN"){
			$badge_bg="badge-primary";
		}

		echo '<span class="badge badge-pill '.$badge_bg.'">'.$dataview->status_pengajuan.'</span><br/><span class="">'.$dataview->judul_penelitian.'</span><br/><span class="text-danger font-italic">[Skema: '.$dataview->nama_skema_lookup.']</span>';?>
		<br/><br/>
		<?php
		echo '<span class="text-medium text-muted">';
		echo 'Ketua: <strong>'.$dataview->nama_lookup.'</strong><br/>';
		echo 'Dana disetujui: <strong>Rp. '.number_format($dataview->dana_disetujui,0,".",",").'</strong>';
		echo '</span>';?>
	</td>
	<td><?php echo $dataview->tahun_anggaran_lookup;
	if($dataview->jenis_usulan=="PENELITIAN"){
		echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span><br/>';
	}else{
		echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span><br/>';
	};?></td>
	<td>
		<a href="<?php echo site_url('penelitian/capaian/'.$dataview->id_penelitian);?>" class="tip btn btn-primary btn-sm mb-1" title="Isi Capaian"><i class="fa fa-edit"></i> Isi Capaian</a>
		<?php
		$akses=$this->session->userdata("akses");
		if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
			<button type="button" rel="<?php echo $dataview->id_penelitian;?>" class="tip upload btn btn-success btn-sm mb-1" title="Unggah Dokumen Seminar Hasil"><i class="fa fa-upload"></i> Unggah Dokumen</button>
		<?php };?>
		<div class="dropdown">
		  <button class="tip btn btn-warning btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		   <i class="fa fa-download"></i>  Unduh Dokumen
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<?php if($dataview->file_artikel>0 || $dataview->file_borang>0 || $dataview->file_poster>0 ||$dataview->file_profil>0){
				echo '<h6 class="dropdown-header text-medium">Dokumen Tersedia</h6>';
			};?>
		    <a style="display:<?php echo ($dataview->file_artikel>0)?'block':'none';?>;" class="dropdown-item text-primary" href="<?php echo site_url('penelitian/unduh_hasil/'.$dataview->id_penelitian.'/artikel');?>"  title="Unduh Artikel Ilmiah"><i class="fa fa-file-pdf-o"></i> Unduh Artikel Ilmiah</a>
		    <a style="display:<?php echo ($dataview->file_borang>0)?'block':'none';?>;" class="dropdown-item text-success" href="<?php echo site_url('penelitian/unduh_hasil/'.$dataview->id_penelitian.'/borang');?>"  title="Unduh Borang Capaian"><i class="fa fa-file-pdf-o"></i> Unduh Borang Capaian</a>
		    <a style="display:<?php echo ($dataview->file_poster>0)?'block':'none';?>;" class="dropdown-item text-danger" href="<?php echo site_url('penelitian/unduh_hasil/'.$dataview->id_penelitian.'/poster');?>"  title="Unduh Poster"><i class="fa fa-file-picture-o"></i> Unduh Poster</a>
			<a style="display:<?php echo ($dataview->file_profil>0)?'block':'none';?>;" class="dropdown-item text-info" href="<?php echo site_url('penelitian/unduh_hasil/'.$dataview->id_penelitian.'/profil');?>"  title="Unduh Profil"><i class="fa fa-user"></i> Unduh Profil</a>
			<?php if($dataview->file_artikel==0 || $dataview->file_borang==0 || $dataview->file_poster==0 ||$dataview->file_profil==0){
				echo '<div class="dropdown-divider"></div>
				<h6 class="dropdown-header text-medium">Dokumen Belum Unggah</h6>';
			};?>
			<a style="display:<?php echo ($dataview->file_artikel==0)?'block':'none';?>;" class="dropdown-item text-muted" onclick="valert('Maaf, dokumen Artikel Ilmiah masih belum diunggah...');"  title="Unduh Artikel Ilmiah"><i class="fa fa-file-pdf-o"></i> Unduh Artikel Ilmiah</a>
		    <a style="display:<?php echo ($dataview->file_borang==0)?'block':'none';?>;" class="dropdown-item text-muted" onclick="valert('Maaf, dokumen Borang capaian hasil penelitian masih belum diunggah...');"  title="Unduh Borang Capaian"><i class="fa fa-file-pdf-o"></i> Unduh Borang Capaian</a>
		    <a style="display:<?php echo ($dataview->file_poster==0)?'block':'none';?>;" class="dropdown-item text-muted" onclick="valert('Maaf, dokumen Poster masih belum diunggah...');"  title="Unduh Poster"><i class="fa fa-file-picture-o"></i> Unduh Poster</a>
			<a style="display:<?php echo ($dataview->file_profil==0)?'block':'none';?>;" class="dropdown-item text-muted" onclick="valert('Maaf, dokumen profil masih belum diunggah...');"  title="Unduh Profil"><i class="fa fa-user"></i> Unduh Profil</a>
		  </div>
		</div>
	</td>
</tr>
<?php }
}else{
	echo '<tr><td colspan="5"><div class="alert alert-danger h3">Maaf, tidak ditemukan data....</div></td></tr>';
};?>
</tbody>
<tfoot>
	<tr>
	<td>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" name="checkAll2" id="checkAll2" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
			<label class="custom-control-label" for="checkAll2"> All</label>
		 </div>
	</td>
	<td colspan="5">
		<?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ;?>
			<button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		<?php };?>
		&nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,
	</td>
	</tr>
</tfoot>
</table>
</form>
<div  id="link_pagination" class="float-md-right"><?php echo $links?></div>
</div><!--End of Table Responsive-->

<script type="text/javascript">
function valert(v){
	alert(v);
}
var item_global=new Array();

$("#link_pagination ul a").click(function(){
	var link=$(this).attr("href");
	reload_data(link);
	return false;
})

function selectCb(no){
	if ($('#cb_'+no).is(':checked')) {
		$('#cb_'+no).prop( "checked", false );
		$('#tr_'+no).removeClass( "select_warna" );
		removeItem(no);
	}else{
		$('#cb_'+no).prop( "checked", true );
		$('#tr_'+no).addClass( "select_warna" );
		addItem(no);
	}
}

function addItem(item){
	if(item_global.indexOf(item)==-1)
	item_global.push(item);
	countItem();
}

function removeItem(item){
	var index = item_global.indexOf(item);
    if (index > -1) {
       item_global.splice(index, 1);
    }
	countItem();
}

function countItem(){
	if(item_global.indexOf('selectAll') > -1){
		var index = item_global.indexOf('selectAll');
		if (index > -1) {
		   item_global.splice(index, 1);
		}
	}
	var citem=item_global.length;
	$(".c_hapus").html('<i class="uk-icon-remove"></i> Delete ('+citem+')');
}

$(".cekAll").click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(":checkbox").each(function() {
          this.checked = true; $("tbody tr").addClass( "select_warna" );
		  addItem(this.value);
      });
  }
  else {
    $(":checkbox").each(function() {
          this.checked = false; $("tbody tr").removeClass( "select_warna" );
		  removeItem(this.value);
      });
  }
});

$(document).ready(function(){
	$('.tip').tooltip();

	$(".upload").click(function(){
		var id_penelitian=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('berkas/berkas_add_hasil');?>",
				dataType  : "html",
				type      : "POST",
				data      : "id_penelitian="+id_penelitian,
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#modalTitle").html("<h4>Unggah Berkas Laporan Kemajuan</h4>");
							$("#dataview_modal").html(data);
							$("#modalView").modal("show");
				}
			});

	});

});
</script>
