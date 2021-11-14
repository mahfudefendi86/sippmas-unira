<?php if(isset($penelitian)){
    $is_edit=(isset($penelitian));
?>
<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="row justify-content-md-center">
         <a id="add" title="Tambah Daftar Catatan Harian" ><button class="btn btn-sm btn-primary ml-3 my-1"><span class="fa fa-plus"></span> Tambah Catatan</button></a>
         <!-- <?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ;?>
             <a id="search" title="Cari Data" ><button class="btn btn-sm btn-warning ml-2 my-1"><span class="fa fa-search"></span> Cari Data</button></a>
         <?php };?> -->
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-sm btn-info ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
         <a id="kembali" title="Kembali" onclick="window.history.back();" ><button class="btn btn-sm btn-warning ml-2 my-1"><span class="fa fa-chevron-left"></span> Kembali</button></a>
      </div>
   </div>
</div>
<div class="card mb-3 bg-light">
    <div class="card-header" data-toggle="collapse" href="#collapsePenelitian" role="button" >
        Judul: <span class="text-secondary h6"><?php echo $penelitian->judul_penelitian;?></span>
        <a class="float-md-right" data-toggle="collapse" href="#collapsePenelitian" role="button" aria-expanded="false" aria-controls="collapsePenelitian" >
            <i class="fa fa-table" title="Tampilkan Data Penelitian" data-toggle="tooltip"></i>
        </a>
    </div>
    <div class="card-body pb-1 collapse" id="collapsePenelitian">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                    <div class="text-center">
                        <?php
                        if($penelitian->foto_thumb!="" || $penelitian->foto_thumb!=NULL){
                            $url=base_url().$penelitian->foto_thumb;
                        }else{
                            $url=base_url()."asset/images/no-image.png";
                        };?>
                        <img src="<?php echo $url;?>" width="100px" height="100px" alt="foto" class="img-thumbnail rounded" />
                        <p class="mt-2 text-primary"><?php echo $penelitian->nama_lookup;?><br/>
                        <span class="my-0 text-medium text-muted">NIDN. <?php echo $penelitian->nidn;?></span></p>
                    </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <table class="table table-sm table-striped">
                    <tr>
                        <th width="20%">Status</th>
                        <td width="80%">: <span class="badge badge-primary h4"><?php echo (!$is_edit) ? '' : $penelitian->status_pengajuan;?></span></td>
                    </tr>
                    <tr>
                        <th>Tahun Anggaran</th><td>: <?php echo $penelitian->tahun_anggaran_lookup;?></td>
                    </tr>
                    <tr>
                        <th>Jenis usulan</th><td>: <?php
                        if($penelitian->jenis_usulan=="PENELITIAN"){
                    		echo '<span class="badge badge-pill badge-success"><i class="fa fa-gear"></i> Penelitian</span>';
                    	}else{
                    		echo '<span class="badge badge-pill badge-warning"><i class="fa fa-user"></i> Pengabdian</span>';
                    	};?></td>
                    </tr>
                    <tr>
                        <th>Skema</th><td>: <?php echo $penelitian->nama_skema_lookup;?></td>
                    </tr>
                    <tr>
                        <td></td><td>&nbsp;<a href="<?php echo site_url('penelitian/detail/'.$penelitian->id_penelitian);?>" class="btn btn-sm btn-success" ><i class="fa fa-cogs"></i> Detail</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 bg-light">
    <div class="card-body pb-1">
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
        		<select name="slct_bulan" id="slct_bulan" class="custom-control custom-select" onchange="reload_data();">
        			<option value="">Pilih Bulan</option>
        			<?php
                        $bln=array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
                        foreach ($bln as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
        			?>
        		</select>
        	</div>
        	<div class="col-md-3 col-sm-12 mb-1">
        		<select name="slct_tahun" id="slct_tahun" class="custom-control custom-select" onchange="reload_data();">
        			<option value="">Pilih Tahun</option>
        			<?php
                        $nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);
                        $nyear=date("Y",$nextyear);
        				for($x=2017;$x<=$nyear;$x++){
                            echo '<option value="'.$x.'">'.$x.'</option>';
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
        <div id="alert_info"></div>
        <div id="dataview" ></div>
    </div>
</div>
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
	var bulan=$("#slct_bulan").val();
    var tahun=$("#slct_tahun").val();
    var id_penelitian="<?php echo $penelitian->id_penelitian;?>";
	if(url == null || url == undefined){
		seturl="<?php echo site_url('catatan/catatan_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row="+row+"&bulan="+bulan+"&tahun="+tahun+"&cari="+cari+"&id_penelitian="+id_penelitian,
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
			url       : "<?php echo site_url('catatan/catatan_add/'.$penelitian->id_penelitian);?>",
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#ajax_loader").fadeOut(100);
						$("#modalTitle").html("<h4>Tambah Data Catatan</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});

 $('[data-toggle="tooltip"]').tooltip();

</script>
<?php }else{ ;?>
	<div class="card">
		<div class="card-body">
			<h3 class="text-danger"><i class="fa fa-warning"></i> Maaf, Data Proposal Penelitian tidak ditemukan</h3><br/>
            <a href="<?php echo site_url('penelitian/catatan/');?>" class="btn btn-warning btn-sm"><i class="fa fa-chevron-left"></i> Kembali</a>
		</div>
	</div>
<?php
}
;?>
