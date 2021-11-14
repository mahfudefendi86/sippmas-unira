
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-sm table-hover table-bordered table-striped" id="tabel_slideshow">
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
	<th width="3%">No.</th>
	<th width="17%">Nama Slide</th>
	<th width="15%">Gambar</th>
	<th width="45%">Deskripsi</th>
	<th width="10%">Link</th>
	<th width="10%">Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($slideshow as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_slideshow;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_slideshow;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_slideshow;?>" value="<?php echo $dataview->id_slideshow;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_slideshow;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td><?php echo $dataview->judul_slide;?></td>
	<td>

			<div class="fill" style="width:120px; height:80px;">
			<?php
				if($dataview->gambar!="" || $dataview->gambar!=NULL){
					echo '<a href="'.base_url().$dataview->gambar.'" data-fancybox="group" title="'.$dataview->judul_slide.'">';
					echo '<img src="'.base_url().$dataview->gambar.'" title="'.$dataview->judul_slide.'" width="100px" />';
					echo '</a>';
				}else{
					echo '<img src="'.base_url().'asset/images/no-image-available.png" title="tidak ada gambar" width="100px" />';
				}
			;?>
			</div>

	</td>
	<td><?php echo '<span class="text-muted text-small"><i class="fa fa-calendar"></i> '.tgl_indo($dataview->tanggal).' &nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark"></i>  '.$dataview->status.' &nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i>  '.$dataview->nama.'</span><br/>'.$dataview->deskripsi;?></td>
	<td>
		<?php
		if($dataview->link!="" || $dataview->link!=NULL){
			$headlink="";
			if (strpos($dataview->link, "http://") !== false || strpos($dataview->link, "https://") !== false) {
			    echo '<a target="_blank" class="btn btn-sm btn-light" href="'.$dataview->link.'" title="tes link"><i class="fa fa-link"></i> Link</a>';
			}else{
				echo '<a target="_blank" class="btn btn-sm btn-light" href="http://'.$dataview->link.'" title="tes link"><i class="fa fa-link"></i> Link</a>';
			}
		}
		;?>
	</td>

	<td>
		<button type="button" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_slideshow;?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
		<button type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_slideshow;?>"  title="Delete Data"><i class="fa fa-remove"></i></button>
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
			url       : "<?php echo site_url('slideshow/slideshow_actionAll');?>/"+act,
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
				url       : "<?php echo site_url('slideshow/slideshow_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Slideshow");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('slideshow/slideshow_dlt');?>/"+id,
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
