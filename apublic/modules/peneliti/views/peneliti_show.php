
<style>
.select_warna{
	background:#ffd5ba !important;
}
</style>
<div class="table-responsive" >
<form name="form_cb" id="form_cb" class="uk-form" >
<table class="table table-lg table-hover table-bordered table-striped" id="tabel_peneliti">
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
</tr>
<tr>
	<th>No.</th>
	<th></th>
	<th width="20%">Nama Lengkap</th>
	<th  width="20%">Email</th>
	<th>Fakultas</th>
	<th>Prog.Studi</th>
	<th>Action</th>
</tr>
	</thead>
<tbody>
<?php
	(isset($start))?$no=$start:$no=0;
	foreach($peneliti as $dataview){
		$no++;
		$nidn=($dataview->nidn!="" || $dataview->nidn!=NULL )? $dataview->nidn:"";
;?>
<tr>
<tr id="tr_<?php echo $dataview->id_user;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td onclick="selectCb('<?php echo $dataview->id_user;?>');" >
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="cb[]" id="cb_<?php echo $dataview->id_user;?>" value="<?php echo $dataview->id_user;?>" />
			<label class="custom-control-label" for="cb_<?php echo $dataview->id_user;?>"> <?php echo $no;?></label>
       </div>
	</td>
	<td>
		<?php if($dataview->foto=="" || $dataview->foto==NULL){
			echo '<div class="fill" style="width:70px; height:70px">';
			echo '<img src="'.base_url().'asset/images/no-image.png" class="img-thumbnail"/>';
			echo '</div>';
		}else{
		;?>
		<a href="<?php echo base_url().$dataview->foto;?>" data-fancybox="group" title="<?php echo $dataview->nama." / NIDN: ".$nidn;?>">
			<div class="fill" style="width:70px; height:90px">
	  			<img  src="<?php echo base_url().$dataview->foto_thumb;?>" alt="foto of <?php echo $dataview->nama;?>"/>
			</div>
		</a>
	<?php };?>
	</td>
	<td><?php
	echo $dataview->nama.'<br/><span class="text-danger text-medium" data-toggle="tooltip" title="Nomer NIDN">[ '.$nidn.' ]</span>';?></td>
	<td><?php echo $dataview->email;?></td>
	<td><?php echo $dataview->nama_fakultas;?></td>
	<td><?php echo $dataview->nama_prodi;?></td>
	<td>
		<div class="dropdown">
		  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		    <a href="#" class="dropdown-item setup_login" rel="<?php echo $dataview->id_user;?>"><i class="fa fa-lock"></i> Setup Login</a>
		    <a class="dropdown-item" href="<?php echo site_url('peneliti/foto/'.$dataview->id_user);?>"><i class="fa fa-image"></i> Upload Foto</a>
			<div class="dropdown-divider"></div>
		    <a href="#" class="edit dropdown-item" rel="<?php echo $dataview->id_user;?>"  title="Edit Data"><i class="fa fa-pencil"></i> Edit</a>
			<a href="#" class="delete dropdown-item" rel="<?php echo $dataview->id_user;?>"  title="Delete Data"><i class="fa fa-remove"></i> Delete</a>
		  </div>
		</div>
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
	<td colspan="7">
		<button type="button" onclick="actionAll('delete');" name="btn_hapus2" id="btn_hapus2" class="btn btn-danger btn-sm c_hapus" title="Delete Data"><i class="fa fa-remove"></i> Delete</button>
		&nbsp;&nbsp;&nbsp;Menampilkan record ke <?php echo ($start+1);?> - <?php echo $end;?> dari <?php echo $total_rows;?> data ditemukan,
	</td>
	</tr>
</tfoot>
</table>
</form>
<div  id="link_pagination" class="float-md-right"><?php echo $links?></div>
</div><!--End of Table Responsive-->

<!-- END FABCYBOX -->

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
			 if (!confirm("Apakah anda yakin akan menghapus data Dosen ?")) return false;
		}
		$.ajax({
			url       : "<?php echo site_url('peneliti/peneliti_actionAll');?>/"+act,
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
		alert("<h3>Maaf anda belum memilih Record...</h3>");
	}
}
$(document).ready(function(){
	$(".setup_login").click(function(){
		var id_user=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('userlogin/userlogin_add/p');?>/"+id_user,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Setup Userlogin Dosen");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".edit").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
				url       : "<?php echo site_url('peneliti/peneliti_upd');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							$("#ajax_loader").fadeOut(100);
							$("#dataview_modal").html(data);
							$("#modalTitle").html("Edit Data Dosen");
							$("#modalView").modal("show")
				}
			}); //end Of Ajax

	});

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('peneliti/peneliti_dlt');?>/"+id,
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
