<?php $akses=$this->session->userdata("akses");?>
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-sm table-hover table-bordered table-striped" id="tabel_capaian_seminar">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="4">
		<!-- <button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button> -->
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th width="5%">No.</th>
	<th width="30%">Pertemuan Ilmiah</th>
	<th width="50%">Judul Makalah</th>
	<th width="15%">Action</th>
</tr>
	</thead>
<tbody>
<?php
(isset($start))?$no=$start:$no=0;
if(count($capaian_seminar)>0){
	foreach($capaian_seminar as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_seminar;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_seminar;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_seminar;?>" value="<?php echo $dataview->id_seminar;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_seminar;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td class="pb-3"><?php echo '<span class="text-primary font-weight-bold">'.$dataview->nama_pertemuan.'</span><br/><span class="text-secondary text-medium">Pertemuan: <strong><em>'.$dataview->jenis_pertemuan.'</em></strong><br/> di <strong><em>'.$dataview->tempat.'</em></strong><br/> pada tanggal: <strong><em>'.tgl_indo($dataview->tanggal).'</em></strong></span>';?></td>
	<td class="pb-3"><?php echo '<span class="text-primary font-weight-bold">'.$dataview->judul_makalah.'</span><br/><span class="text-secondary text-medium">Status Makalah: <strong><em>'.$dataview->status_makalah.'</em></strong></span>';?></td>
	<td>
		<button type="button" class="tip upload btn btn-success btn-sm" rel="<?php echo $dataview->id_seminar;?>"  title="Unggah Berkas"><i class="fa fa-upload"></i></button>
		<?php if($dataview->file_url!=NULL || $dataview->file_url!=""){ ;?>
			<a target="_blank" href="<?php echo site_url('capaian_seminar/unduh/'.$dataview->id_seminar);?>"><button type="button" class="tip download btn btn-warning btn-sm"  title="Unduh Berkas"><i class="fa fa-download"></i></button></a>
		<?php }else{ ;?>
			<button type="button" disabled class="tip download btn btn-default btn-sm"  title="Unduh Berkas"><i class="fa fa-download"></i></button>
		<?php };?>
		<?php if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
			<button type="button" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_seminar;?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
			<button type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_seminar;?>"  title="Delete Data"><i class="fa fa-remove"></i></button>
		<?php };?>
	</td>
</tr>
<?php }
}else{
	echo '<tr><td colspan="4" class=" text-center"><span class="text-danger">Belum ada data luaran sebagai Pembicara pada Pertemuan Ilmiah (Seminar/Simposium)...</span></td></tr>';
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
	<td colspan="4">
		<!-- <button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button> -->
		&nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,
	</td>
	</tr>
</tfoot>
</table>
</form>
<div  id="link_pagination_seminar" class="float-right mr-3"><?php echo $links?></div>
</div><!--End of Table Responsive-->

<script type="text/javascript">
var item_global=new Array();

$("#link_pagination_seminar ul a").click(function(){
	var link=$(this).attr("href");
	if(link!='#'){
		reload_data_seminar(link);
	}
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
	$(".upload").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('capaian_seminar/upload_file');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Unggah Dokumen Pertemuan Ilmiah (Seminar/Simposium)");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".edit").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('capaian_seminar/capaian_seminar_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Capaian_seminar");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('capaian_seminar/capaian_seminar_dlt');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_data_seminar();
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
							$("#ajax_loader").fadeOut(100);
				}
			}); //end Of Ajax
		}
	});

});
</script>
