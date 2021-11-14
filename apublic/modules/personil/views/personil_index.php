<?php if(isset($penelitian)){
    $is_edit=(isset($penelitian));
?>
<h3 id="title" class="border-bottom border-primary text-primary pb-2" >Usulan <?php echo ucfirst(strtolower($penelitian->jenis_usulan));?></h3>
<div class="card mb-3">
    <div class="card-body">
        <table class="table table-sm table-hover table-striped">
            <tr>
                <th width="20%">Status</th><td width="80%">: <span class="badge badge-primary h4"><?php echo (!$is_edit) ? '' : $penelitian->status_pengajuan;?></span></td>
            </tr>
            <tr>
                <th>Ketua/Pengusul</th><td>: <strong><?php echo $penelitian->nama_lookup;?></strong></td>
            </tr>
            <tr>
                <th>Tahun anggaran</th><td>: <?php echo $penelitian->tahun_anggaran_lookup;?></td>
            </tr>
            <tr>
                <th>Judul <?php echo strtolower($penelitian->jenis_usulan);?></th><td>: <?php echo $penelitian->judul_penelitian;?></td>
            </tr>
            <tr>
                <th>Skema <?php echo strtolower($penelitian->jenis_usulan);?></th><td>: <?php echo $penelitian->nama_skema_lookup;?></td>
            </tr>
            <tr>
                <td></td><td>&nbsp;<a href="<?php echo site_url('penelitian/detail/'.$penelitian->id_penelitian);?>" class="btn btn-sm btn-success" ><i class="fa fa-cogs"></i> Detail Usulan</a></td>
            </tr>
        </table>

    </div>
</div>
<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="float-md-right">
         <a id="add" title="Tambah Daftar Pent" ><button class="btn btn-primary btn-sm ml-3 my-1"><span class="fa fa-plus"></span> Tambah Personil</button></a>
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-info btn-sm ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
         <a id="back" title="Kembali" onclick="window.history.back();" ><button class="btn btn-warning btn-sm ml-2 my-1"><span class="fa fa-chevron-left"></span> Kembali</button></a>
      </div>
   </div>
</div>
<div class="row my-2">
	<div class="col-md-4 col-sm-12 mb-1">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Tampil</div>
        </div>
         <select name="slct_row" id="slct_row" class="form-control" onchange="reload_data();">
   			<option value="5">5 baris</option>
   			<option value="10" selected>10 baris</option>
   			<option value="15">15 baris</option>
   			<option value="25">25 baris</option>
   			<option value="50">50 baris</option>
   			<option value="75">75 baris</option>
   			<option value="100">100 baris</option>
   		</select>
      </div>
	</div>

	<div class="col-md-4 col-sm-12 mb-1">
		<select name="slct_filter" id="slct_filter" class="custom-control custom-select">
			<option value="">Pilih Filter</option>
			<?php
				if(isset($op_search)){
					foreach($op_search as $opkey=>$opval){
						echo '<option value="'.$opkey.'">'.$opval.'</option>';
					}
				}
			?>
		</select>
	</div>
	<div class="col-sm-12 col-md-4 mb-1">
      <div class="input-group">
         <input type="text" name="tb_filter" id="tb_filter" class="form-control border-right-0 border" placeholder="Kata Kunci Pencarian" onkeyup="switch_icon();">
         <span class="input-group-append" id="icon_search">
            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
         </span>
      </div>
	</div>
</div>
<input type="hidden" name="id_penelitian" id="id_penelitian" value="<?php echo $penelitian->id_penelitian;?>" />
<div id="alert_info"></div>
<div id="dataview" ></div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal label" aria-hidden="true" id="modalView" data-backdrop="static">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
		 <div class="modal-header">
			<h5 class="modal-title" id="modalTitle">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div id="dataview_modal"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
		  </div>
	</div>
  </div>
</div>


<?php
(isset($s))? $start=$s : $start=0 ;
?>
<script type="text/javascript">
setTimeout("reload_data()",1);

function switch_icon(cls){
	if(cls==="TRUE"){
        $("#tb_filter").val("");
    };
    var i=$("#tb_filter").val();
    if(i==""){
        $("#icon_search").html('<div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>');
    }else{
        $("#icon_search").html('<div style="cursor:pointer;" onclick="switch_icon(\'TRUE\');" class="input-group-text bg-transparent"><i class="fa fa-remove"></i></div>');
    }
    reload_data();
};

function reload_data(url){
	var row=$("#slct_row").val();
	var cari=$("#tb_filter").val();
	var filter=$("#slct_filter").val();
    var id=$("#id_penelitian").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('personil/personil_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row="+row+"&filter="+filter+"&cari="+cari+"&id_penelitian="+id,
		beforeSend	: function(){
						$("#ajax_loader").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_loader").fadeOut(100);
						$("#dataview").html(data);
		}
	});///end of ajax
}

$("#add").click(function(){
	$.ajax({
			url       : "<?php echo site_url('personil/personil_add/'.$penelitian->id_penelitian);?>",
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#ajax_loader").fadeOut(100);
						$("#modalTitle").html("<h4>Tambah Data Personil</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});

</script>
<?php }else{ ;?>
	<div class="card">
		<div class="card-body">
			<h3 class="text-danger"><i class="fa fa-warning"></i> Maaf, Data Proposal Penelitian tidak ditemukan</h3><br/>
            <a href="<?php echo site_url('penelitian');?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
		</div>
	</div>
<?php
}
;?>
