
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<h3 class="text-primary"><?php echo $title;?></h3>
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
	<td colspan="7">
		&nbsp;&nbsp;&nbsp;<strong><i>Ditemukan data sebanyak <?php echo $total_rows;?> record</strong>
	</td>
</tr><tr>
	<th width="5%">No.</th>
	<th width="10%">Jenis Usulan</th>
	<th width="40%">Judul</th>
	<th width="10%">Thn Anggaran</th>
	<th width="10%">Status</th>
	<th width="13%">Dana Usulan (Rp.)</th>
	<th width="13%">Disetujui (Rp.)</th>
</tr>
	</thead>
<tbody>
<?php
(isset($start))?$no=$start:$no=0;
if(isset($penelitian)){
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
	if($dataview->jenis_usulan=="PENELITIAN"){
		echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span>';
	}else{
		echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span>';
	};
	?></td>
	<td><?php echo '<span class="">'.$dataview->judul_penelitian.'</span><br/><span class="text-danger font-italic">[Skema: '.$dataview->nama_skema.']</span>';?></td>
	<td><?php echo $dataview->tahun_anggaran;?></td>
	<td><?php
	if($dataview->status_pengajuan=="DISETUJUI"){
		echo '<span class="badge badge-pill badge-success"><i class="fa fa-check-circle"></i> '.$dataview->status_pengajuan.'</span>';
	}else
	if($dataview->status_pengajuan=="DITOLAK"){
		echo '<span class="badge badge-pill badge-danger"><i class="fa fa-times-circle"></i> '.$dataview->status_pengajuan.'</span>';
	}else
	if($dataview->status_pengajuan=="REVISI"){
		echo '<span class="badge badge-pill badge-warning"><i class="fa fa-warning"></i> '.$dataview->status_pengajuan.'</span>';
	}else
	if($dataview->status_pengajuan=="PENGAJUAN"){
		echo '<span class="badge badge-pill badge-primary"><i class="fa fa-paper-plane"></i> '.$dataview->status_pengajuan.'</span>';
	}
	;?></td>
	<td align="right">
		<?php echo number_format($dataview->dana_usulan,0,",",".");?>
	</td>
	<td align="right">
		<?php echo number_format($dataview->dana_disetujui,0,",",".");?>
	</td>
</tr>
<?php }
}else{
	echo '<tr><td colspan="7"><div class="alert alert-danger h3">Maaf, tidak ditemukan data....</div></td></tr>';
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
	<td colspan="7">
		&nbsp;&nbsp;&nbsp;<strong><i>Ditemukan data sebanyak <?php echo $total_rows;?> record</strong>
	</td>
	</tr>
</tfoot>
</table>
</form>

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

	$(".plot").click(function(){
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


});
</script>
