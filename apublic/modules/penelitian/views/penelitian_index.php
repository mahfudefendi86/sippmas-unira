<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="float-md-right">
         <?php if(!isset($status)){ ;?>
             <a id="add" title="Tambah Daftar Usulan" href="<?php echo site_url('penelitian/penelitian_add');?>"><button class="btn btn-primary btn-sm ml-3 my-1"><span class="fa fa-plus"></span> Pengajuan</button></a>
         <?php };?>
         <?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ;?>
             <a id="search" title="Cari Data" ><button class="btn btn-warning btn-sm ml-2 my-1"><span class="fa fa-search"></span> Cari Data</button></a>
        <?php };?>
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-info btn-sm ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
      </div>
   </div>
</div>
<div class="row my-2">
	<div class="col-md-3 col-sm-12 mb-1">
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

	<div class="col-md-3 col-sm-12 mb-1">
        <select name="slct_anggaran" id="slct_anggaran" class="custom-control custom-select" onchange="reload_data();">
			<option value="401">Pilih Tahun Anggaran</option>
			<?php
				if(isset($anggaran)){
					foreach($anggaran as $dataview){
						echo '<option value="'.$dataview->id_anggaran.'">'.$dataview->tahun_anggaran.'</option>';
					}
				}
			?>
		</select>
	</div>
    <div class="col-md-3 col-sm-12 mb-1">
        <select name="st_usulan" id="st_usulan" class="custom-control custom-select" onchange="update_status(this.value);">
            <?php if(isset($status) && $status=="DISETUJUI"){
                echo '<option value="DISETUJUI">DISETUJUI</option>';
            }else{
            ;?>
            <option value="PRT">Semua Status</option>
			<?php
				$s=array('DITOLAK','REVISI','PENGAJUAN');
                foreach ($s as $status_pengajuan) {
                    echo '<option value="'.$status_pengajuan.'">'.$status_pengajuan.'</option>';
                }
            }
			?>
		</select>
	</div>
	<div class="col-sm-12 col-md-3 mb-1">
      <div class="input-group">
         <input type="text" name="tb_filter" id="tb_filter" class="form-control border-right-0 border" placeholder="Kata Kunci Pencarian" onkeyup="switch_icon();">
         <span class="input-group-append" id="icon_search">
            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
         </span>
      </div>
	</div>
</div>
<input type="hidden" name="status" id="status" value="<?php echo isset($status)?$status:'PRT';?>" />
<input type="hidden" name="link" id="link" value="<?php echo isset($status)?strtolower($status):'PENGAJUAN';?>" />
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

<script type="text/javascript">
var link="<?php echo site_url('penelitian/penelitian_show');?>/0";
function update_link(n){
    link=n;
    reload_data();
}

setTimeout("reload_data()",300);

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

function update_status(val){
    $("#status").val(val);
    reload_data();
}

function reload_data(url){
	var row=$("#slct_row").val();
	var cari=$("#tb_filter").val();
	var anggaran=$("#slct_anggaran").val();
    var status=$("#status").val();
    var status_link_show=$("#link").val();
	if(url == null || url == undefined){
		seturl=link;
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row="+row+"&anggaran="+anggaran+"&cari="+cari+"&status="+status+"&link="+status_link_show,
		beforeSend	: function(){
						$("#ajax_loader").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_loader").fadeOut(100);
						$("#dataview").html(data);
		}
	});///end of ajax
}

$("#search").click(function(){
	$.ajax({
			url       : "<?php echo site_url('penelitian/penelitian_search/'.(isset($status)?$status:'PRT') );?>",
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#dataview_modal").html(data);
						$("#modalTitle").html("<h4>Cari Data</h4>");
						$("#modalView").modal("show");
						$("#ajax_loader").fadeOut(100);
			}
		});
});

</script>
