
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-hover table-bordered table-striped" id="tabel_anggaran">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="7">
		<button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th>No.</th>
	<th>Tahun Anggaran</th>
	<th>Jumlah Anggaran</th>
	<th>Jadwal Upload Proposal</th>
	<th>Jadwal Upload Laporan</th>
	<th>Status</th>
	<th>Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($anggaran as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_anggaran;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_anggaran;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_anggaran;?>" value="<?php echo $dataview->id_anggaran;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_anggaran;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td><?php echo $dataview->tahun_anggaran;?></td>
	<td class="text-right"><?php echo 'Rp. '.convertRP($dataview->jumlah);?></td>
	<td><?php echo tgl_indo_pendek($dataview->tgl_awal_proposal).'&nbsp;&nbsp; s/d &nbsp;&nbsp;'.tgl_indo_pendek($dataview->tgl_akhir_proposal);?></td>
	<td><?php echo tgl_indo_pendek($dataview->tgl_awal_laporan).'&nbsp;&nbsp; s/d &nbsp;&nbsp;'.tgl_indo_pendek($dataview->tgl_akhir_laporan);?></td>
	<td><?php echo ($dataview->status=="OPEN")?'<span class="badge badge-success">OPEN</span>':'<span class="badge badge-warning">CLOSE</span>';?></td>
	<td>
		<button type="button" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_anggaran;?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
		<button type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_anggaran;?>"  title="Delete Data"><i class="fa fa-remove"></i></button>
</td>
</tr>
<?php };?>
</tbody>
<tfoot>
	<tr>
	<td>
		<div class="custom-control custom-checkbox">
			<input type="checkbox" name="checkAll2" id="checkAll2" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
			<label class="custom-control-label" for="checkAll2"> All</label>
		 </div>
	</td>
	<td colspan="6">
		<button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		&nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,
	</td>
	</tr>
</tfoot>
</table>
</form>
<div  id="link_pagination" class="float-md-right"><?php echo $links?></div>
</div><!--End of Table Responsive-->

<script>
	var item_global=new Array();

	$("#link_pagination ul a").click(function(){
		var link=$(this).attr("href");
		update_link(link);
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

function actionAll(act){
	if(item_global.length>0){ ///untuk cek apakah ada record dipilih atau tidak
		if(act=="delete"){
			 if (!confirm("Apakah anda yakin akan menghapus data ?")) return false;
		}
		$.ajax({
			url       : "<?php echo site_url('anggaran/anggaran_actionAll');?>/"+act,
			type      : "POST",
			dataType  : "html",
			data      : "dataArray="+item_global.sort(),
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						obj = JSON.parse(data);
						if(obj.status=="OK"){
							$("#alert_info").html(obj.msg);
							reload_data();
						}else
						if(obj.status=="ERROR"){
							$("#alert_info").html(obj.msg);
						}
						$("#ajax_loader").fadeOut(100);
			}
		}); //end Of Ajax
	}else{
		UIkit.modal.alert("<h3>Maaf anda belum memilih Record...</h3>");
	}
}
$(document).ready(function(){
	$(".edit").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('anggaran/anggaran_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Anggaran");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('anggaran/anggaran_dlt');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_data();
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
