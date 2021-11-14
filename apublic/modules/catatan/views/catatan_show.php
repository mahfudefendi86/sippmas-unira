
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-lg table-striped" id="tabel_catatan">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="6">
		<button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th width="6%">No.</th>
	<th width="80%">Uarain Kegiatan</th>
	<th width="10%">Action</th>
</tr>
	</thead>
<tbody>
<?php
(isset($start))?$no=$start:$no=0;
if($total_rows>0){
	foreach($catatan as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_catatan;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_catatan;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_catatan;?>" value="<?php echo $dataview->id_catatan;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_catatan;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td>
		<div class="card">
			<div class="card-header">
				<span class="text-muted text-medium"><i class="fa fa-calendar"></i> &nbsp;<?php echo tgl_indo($dataview->tgl); ?></span> &nbsp;|&nbsp;
				<span class="text-primary text-medium"><i class="fa fa-line-chart"></i> Progres Penelitian: <span class="text-large"><?php echo $dataview->persentase;?>%</span></span>
			</div>
			<div class="card-body">
				<div class="text-muted float-md-left mr-3"><i class="fa fa-book fa-2x"></i></div> <?php echo $dataview->uraian;?>
				<div class="border-top mt-3 py-1">
					<span class="text-muted">
						<a style="cursor:pointer;" title="Tambah berkas catatan" data-toggle="tooltip" class="add_berkas text-muted badge badge-light" rel="<?php echo $dataview->id_catatan;?>"><i class="fa fa-plus"></i> Tambah Berkas</a>
						<a style="cursor:pointer;" title="Lihat berkas catatan" data-toggle="tooltip" class="lihat_berkas text-muted badge badge-light" rel="<?php echo $dataview->id_catatan;?>"><i class="fa fa-list-alt"></i> Lihat Berkas <span id="count_berkas_<?php echo $dataview->id_catatan;?>">(<?php echo $dataview->jumlah_berkas;?>)</span></a>
					</span>
					<div style="width:100%; margin:8px 0;" id="berkas_<?php echo $dataview->id_catatan;?>"></div>
				</div>
			</div>
		</div>
	</td>

	<td>
		<button type="button" data-toggle="tooltip" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_catatan;?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
		<button type="button" data-toggle="tooltip" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_catatan;?>"  title="Delete Data"><i class="fa fa-remove"></i></button>
	</td>
</tr>
<?php }
}else{
	echo '<tr><td colspan="4"><div class="alert alert-danger">Maaf data tidak ditemukan....</div></td></tr>';
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
          this.checked = true; $("#tabel_catatan tbody tr").addClass( "select_warna" );
		  addItem(this.value);
      });
  }
  else {
    $(":checkbox").each(function() {
          this.checked = false; $("#tabel_catatan tbody tr").removeClass( "select_warna" );
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
			url       : "<?php echo site_url('catatan/catatan_actionAll');?>/"+act,
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

	 $('[data-toggle="tooltip"]').tooltip();

	$(".edit").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('catatan/catatan_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Catatan");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('catatan/catatan_dlt');?>/"+id,
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

	$(".add_berkas").click(function(){
		var id_catatan=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('berkas/berkas_add_catatan');?>",
				dataType  : "html",
				type      : "POST",
				data      : "id_catatan="+id_catatan,
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#modalTitle").html("<h4>Tambah Berkas Catatan</h4>");
							$("#dataview_modal").html(data);
							$("#modalView").modal("show");
				}
			});
	});

	$(".lihat_berkas").click(function(){
		var id_catatan=$(this).attr("rel");
		reload_berkas(id_catatan);
	});

});

function reload_berkas(id){
	$.ajax({
		url       : "<?php echo site_url('berkas/lihat_berkas_catatan');?>",
		dataType  : "html",
		type      : "POST",
		data      : "id_catatan="+id,
		beforeSend: function(){
					  $("#ajax_loader").fadeIn(100);
		},
		success   : function(data){
					$("#ajax_loader").fadeOut(100);
					$("#berkas_"+id).html(data);
		}
	});
}
</script>
