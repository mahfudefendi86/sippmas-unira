
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-hover table-bordered table-striped" id="tabel_proposal">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="5">
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr>
<tr>
	<th>No.</th>
	<th width="15%">Jenis Berkas</th>
	<th width="40%">Proposal</th>
	<th width="20%">Keterangan</th>
	<th>Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($proposal as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_proposal;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_proposal;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_proposal;?>" value="<?php echo $dataview->id_proposal;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_proposal;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td><?php echo $dataview->jenis_berkas?></td>
	<td><?php
		echo $dataview->file_name.'<br/>';
		$t=explode(" ",$dataview->upload_date);
		echo '<span class="text-muted text-medium"><i class="fa fa-cloud-upload"></i> '.tgl_indo($t[0])." | ".$t[1].'</span>';
	?></td>
	<td><?php echo $dataview->keterangan;?></td>
	<td>
		<a data-toggle="tooltip" title="Lihat Berkas" data-fancybox data-type="iframe" href="javascript:;" data-src="<?php echo site_url('proposal/showup/'.$dataview->id_proposal);?>"  data-caption="Proposal: <?php echo $dataview->judul_penelitian_lookup;?>"><img src="<?php echo base_url();?>asset/imgext/File-PDF-Acrobat-icon.png" /></a>
		<a data-toggle="tooltip" title="Unduh" class="download btn btn-success btn-sm" target="_blank" href="<?php echo site_url('proposal/download_pdf/'.$dataview->id_proposal);?>" ><i class="fa fa-cloud-download"></i></a>
		<?php if($this->session->userdata('akses')=="SUA" || $this->session->userdata('akses')=="ADM"){ ;?>
			<button data-toggle="tooltip" title="Hapus File" type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_proposal;?>" ><i class="fa fa-remove"></i></button>
		<?php };?>
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
	<td colspan="5">
		&nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,
	</td>
	</tr>
</tfoot>
</table>
</form>
<div  id="link_pagination" class="float-md-right"><?php echo $links?></div>
</div><!--End of Table Responsive-->

<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<style>
.fancybox-slide--iframe .fancybox-content {
	width  : 80%;
	height : 100%;
	max-width  : 80%;
	max-height : 100%;
	margin: 0;
}
</style>
<!-- END FABCYBOX -->

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
	 $('[data-toggle="tooltip"]').tooltip();

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('proposal/proposal_dlt');?>/"+id,
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
