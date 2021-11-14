
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-hover table-bordered table-striped" id="tabel_kategori">
<thead class="thead-light">
<tr>
	<td>
		<div class="custom-control custom-checkbox">
         <input type="checkbox" name="checkAll" id="checkAll" class="cekAll custom-control-input" value="selectAll" onclick="cekAll();"/>
        <label class="custom-control-label" for="checkAll"> All</label>
      </div>
	</td>
	<td colspan="5">
		<button type="button" name="btn_hapus1" id="btn_hapus1" onclick="actionAll('delete');" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		&nbsp;&nbsp;&nbsp;<strong><i>Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,</i></strong>
	</td>
</tr><tr>
	<th>No.</th>
	<th width="50%">Kategori</th>
	<th>Warna</th>
	<th>Ikon</th>
	<th>Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($kategori as $dataview){
		$no++;
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_kategori;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_kategori;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_kategori;?>" value="<?php echo $dataview->id_kategori;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_kategori;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td><?php echo $dataview->kategori;?></td>
	<td><?php
	if($dataview->warna=="" || $dataview->warna==NULL){
		echo '<div style="background:url('.base_url().'asset/images/trans.png);width:150px; height:30px; color:grey; border:1px solid #cccccc; padding:3px; text-align:center;">Tak Berwarna</div>';
	}else{
		echo '<div style="background:'.$dataview->warna.';width:150px; height:30px; color:white; border:1px solid #cccccc; padding:3px; text-align:center;">'.$dataview->warna.'</div>';
	}
	?>
	</td>
	<td>
		<i class="<?php echo $dataview->ikon;?> fa-2x"></i>
	</td>

	<td>
		<button type="button" class="edit btn btn-primary btn-sm" rel="<?php echo $dataview->id_kategori;?>"  title="Edit Data"><i class="fa fa-pencil"></i></button>
		<button type="button" class="delete btn btn-danger btn-sm" rel="<?php echo $dataview->id_kategori;?>"  title="Delete Data"><i class="fa fa-remove"></i></button>
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
			url       : "<?php echo site_url('kategori/kategori_actionAll');?>/"+act,
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
				url       : "<?php echo site_url('kategori/kategori_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Kategori");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('kategori/kategori_dlt');?>/"+id,
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
