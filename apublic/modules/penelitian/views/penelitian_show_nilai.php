
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
	<th width="5%">No.</th>
	<th width="54%">Judul</th>
	<th width="12%">Jenis Usulan / Anggaran</th>
	<th width="18%">Keterangan</th>
	<th width="11%">Action</th>
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
	<?php
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
	?>
	<td><?php echo '<span class="badge badge-pill '.$badge_bg.'">'.$dataview->status_pengajuan.'</span><br/><span class="">'.$dataview->judul_penelitian.'</span><br/><span class="text-danger font-italic">[Skema: '.$dataview->nama_skema_lookup.']</span>';?></td>
	<td>
	<?php
	if($dataview->jenis_usulan=="PENELITIAN"){
		echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span>';
	}else{
		echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span>';
	};
	echo $dataview->tahun_anggaran_lookup;?></td>
	<td><?php
	echo '<span class="text-medium text-muted">';
	echo 'Ketua: <strong>'.$dataview->nama_lookup.'</strong><br/>';
	echo 'Dana hibah: <strong>Rp. '.number_format($dataview->dana_disetujui,0,".",",").'</strong><br/>';
	echo 'Jumlah catatan: <strong>'.$dataview->jumlah_catatan.'</strong><br/>';
	echo 'Progres: <strong>'.$dataview->progres.'%</strong><br/>';
	echo '</span>';?></td>
	<td>
		<div class="dropdown">
		  <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<?php if($this->session->userdata('akses')=="SUA" || $this->session->userdata('akses')=="ADM"){ ;?>
				<a title="hasil nilai hasil review" data-toggle="tooltip" class="dropdown-item text-primary" href="<?php echo site_url('nilairev/hasil/'.$dataview->id_penelitian);?>"><i class="fa fa-edit"></i> Hasil Nilai Review</a>
				<?php
				  }else{
				?>
			  	<a title="Input nilai hasil review" data-toggle="tooltip" class="dropdown-item text-primary" href="<?php echo site_url('nilairev/input/'.$dataview->id_penelitian);?>"><i class="fa fa-edit"></i> Input Nilai Review</a>
				<?php };?>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo site_url('penelitian/detail/'.$dataview->id_penelitian);?>"><i class="fa fa-cogs"></i> Detail Usulan</a>
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

function actionAll(act){
	if(item_global.length>0){ ///untuk cek apakah ada record dipilih atau tidak
		if(act=="delete"){
			 if (!confirm("Apakah anda yakin akan menghapus data ?")) return false;
		}
		$.ajax({
			url       : "<?php echo site_url('penelitian/penelitian_actionAll');?>/"+act,
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
				url       : "/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Penelitian");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('penelitian/penelitian_dlt');?>/"+id,
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
