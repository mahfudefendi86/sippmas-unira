
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-striped table-bordered" id="tabel_berita">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="4">
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th>No.</th>
	<th width="70%">Berita</th>
	<th width="10%">Status</th>
	<th width="10%">Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($berita as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_berita;?>" >
	<td onclick="selectCb('<?php echo $dataview->id_berita;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_berita;?>" value="<?php echo $dataview->id_berita;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_berita;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td class="p-1">
			<?php
			echo '<div class="berita">';
			echo '<a href="'.site_url('berita/detail/'.$dataview->id_berita).'"><span class="judul_berita_sm">'.$dataview->judul.'</span></a>';
			echo $dataview->isi_berita.'<br/>';
			echo '<div class="bottom_shade">';
			echo '<div class="widget">';
			echo '<span class="ketagori_berita_sm mr-1" style="background:'.$dataview->warna.';"><i class="'.$dataview->ikon.'"></i> '.$dataview->kategori.'</span>';
			echo '<span class="widget_sm ml-2" ><i class="fa fa-calendar"></i> '.tgl_indo($dataview->tanggal).'</span>';
			echo '<span class="widget_sm" ><i class="fa fa-clock-o"></i> '.$dataview->jam.'</span>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			?>
	</td>
	<td><?php echo ($dataview->status=="PUBLISH")?'<span class="badge badge-success">'.$dataview->status.'</span>':'<span class="badge badge-warning">'.$dataview->status.'</span>';?></td>
	<td>
		<button type="button" class="set btn btn-danger btn-sm" id="<?php echo $dataview->id_berita;?>" onclick="get(this.id);" title="Select Data"><i class="fa fa-check-circle"></i> Link</button>
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
	<td colspan="4">
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

// Ambil data link
    function get(id){
        window.opener.getlink("<?php echo site_url("main/detail/");?>"+id);
        window.close();
    }

</script>
