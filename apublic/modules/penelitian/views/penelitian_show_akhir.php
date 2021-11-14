
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
	<td colspan="6">
		<?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ;?>
			<button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		<?php };?>
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th width="6%">No.</th>
	<th>Jenis Usulan</th>
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
	<td>
		<?php
		if($dataview->jenis_usulan=="PENELITIAN"){
			echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span>';
		}else{
			echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span>';
		}; ?>
	</td>
	<td><?php echo '<span class="">'.$dataview->judul_penelitian.'</span><br/><span class="text-danger font-italic">[Skema: '.$dataview->nama_skema_lookup.']</span>';?></td>
	<td><?php echo $dataview->tahun_anggaran_lookup;?></td>
	<td>
		<button type="button" rel="<?php echo $dataview->id_penelitian;?>" class="upload tip btn btn-success btn-sm" title="Unggah Laporan Akhir"><i class="fa fa-upload"></i></button>
		<?php
		if($dataview->file_akhir > 0){
			echo '<a href="'.site_url('penelitian/unduh_akhir/'.$dataview->id_penelitian).'" class="tip btn btn-warning btn-sm" title="Unduh Laporan Akhir"><i class="fa fa-download"></i></a>';
		}else{
			echo '<button type="button" class="tip btn btn-secondary btn-sm" title="Unduh Laporan Kemajuan" disabled><i class="fa fa-download"></i></button>';
		};
		?>
	</td>
</tr>
<?php }
}else{
	echo '<tr><td colspan="6"><div class="alert alert-danger h3">Maaf, tidak ditemukan data....</div></td></tr>';
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

$(document).ready(function(){
	$('.tip').tooltip();

	$(".upload").click(function(){
		var id_penelitian=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('berkas/berkas_add_akhir');?>",
				dataType  : "html",
				type      : "POST",
				data      : "id_penelitian="+id_penelitian,
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#modalTitle").html("<h4>Unggah Berkas Laporan Akhir</h4>");
							$("#dataview_modal").html(data);
							$("#modalView").modal("show");
				}
			});

	});

});
</script>
