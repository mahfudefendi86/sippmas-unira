<?php $akses=$this->session->userdata("akses");?>
<div class="row">
    <div class="col-md-10">
        <h3 class="border-bottom border-primary text-primary pb-2"><?php echo $title;?></h3>
    </div>
    <div class="col-md-2">
        <div class="btn-group mb-3" style="width:100%;">
              <button type="button" class="btn btn-sm btn-danger dropdown-toggle  btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-gears"></i> Action
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" target="_blank" href="<?php echo site_url('penelitian/cetak_capaian/'.$penelitian->id_penelitian);?>"><i class="fa fa-file-pdf-o"></i> cetak PDF</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="window.history.back();"><i class="fa fa-chevron-left"></i> Kembali</a>
              </div>
        </div>
    </div>
</div>
<input type="hidden" name="id_penelitian" id="id_penelitian" value="<?php echo $penelitian->id_penelitian;?>" />
<div class="card mb-4 bg-primary">
    <div class="card-header text-white">
        <div class="row">
            <div class="col-md-9">
                <span class="h6">1. Publikasi Ilmiah </span><span id="ajax_jurnal" class="text-medium">&nbsp;&nbsp;<img src="<?php echo base_url();?>asset/images/ajax-loader.gif" alt="loading publikasi ilmiah" width="18px"/> Loading...</span>
            </div>
            <div class="col-md-3" >
               <?php if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
                   <a id="add_jurnal" style="cursor:pointer;" title="Tambah Data Publikasi Ilmiah" ><i class="fa fa-plus"></i> Tambah Data</a> &nbsp; &nbsp;
               <?php };?>
               <a id="refresh_jurnal" style="cursor:pointer;" title="Refresh" onclick="reload_data_jurnal();" ><i class="fa fa-refresh"></i> Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body p-1">
        <div id="dataview_jurnal" class="bg-light rounded"></div>
    </div>
</div>

<div class="card mb-4 bg-success">
    <div class="card-header text-white">
        <div class="row">
            <div class="col-md-9">
            <span class="h6">2. Buku Ajar </span><span id="ajax_buku" class="text-medium">&nbsp;&nbsp;<img src="<?php echo base_url();?>asset/images/ajax-loader.gif" alt="loading buku ajar" width="18px"/> Loading...</span>
        </div>
        <div class="col-md-3" >
            <?php if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
                <a id="add_buku" style="cursor:pointer;" title="Tambah Data Buku Ajar" ><i class="fa fa-plus"></i> Tambah Data</a> &nbsp; &nbsp;
            <?php };?>
           <a id="refresh_buku" style="cursor:pointer;" title="Refresh" onclick="reload_data_buku();" ><i class="fa fa-refresh"></i> Refresh</a>
        </div>
    </div>
    </div>
    <div class="card-body p-1">
        <div id="dataview_buku" class="bg-light rounded"></div>
    </div>
</div>

<div class="card mb-4 bg-warning">
    <div class="card-header text-white">
        <div class="row">
            <div class="col-md-9">
                <span class="h6">3. Pembicara pada Pertemuan Ilmiah (Seminar/Simposium)</span>
                <span id="ajax_seminar" class="text-medium">&nbsp;&nbsp;<img src="<?php echo base_url();?>asset/images/ajax-loader.gif" alt="loading Seminar" width="18px"/> Loading...</span>
            </div>
            <div class="col-md-3" >
                <?php if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
                    <a id="add_seminar" style="cursor:pointer;" title="Tambah Data Pembicara pada Pertemuan Ilmiah (Seminar/Simposium)" ><i class="fa fa-plus"></i> Tambah Data</a> &nbsp; &nbsp;
                <?php };?>
               <a id="refresh_seminar" style="cursor:pointer;" title="Refresh" onclick="reload_data_seminar();" ><i class="fa fa-refresh"></i> Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body p-1">
        <div id="dataview_seminar" class="bg-light rounded"></div>
    </div>
</div>
<div class="card mb-4 bg-danger">
    <div class="card-header text-white">
        <div class="row">
            <div class="col-md-9">
                <span class="h6">4. Capaian Luaran Lainnya</span>
                <span id="ajax_lainnya" class="text-medium">&nbsp;&nbsp;<img src="<?php echo base_url();?>asset/images/ajax-loader.gif" alt="loading Lainnya" width="18px"/> Loading...</span>
            </div>
            <div class="col-md-3" >
                <?php if($akses=="ADM" || $akses=="SUA" || $akses=="PENELITI"){ ;?>
                    <a id="add_lainya" style="cursor:pointer;" title="Tambah Data capaian luaran lainnya" ><i class="fa fa-plus"></i> Tambah Data</a> &nbsp; &nbsp;
                <?php };?>
               <a id="refresh_lainnya" style="cursor:pointer;" title="Refresh" onclick="reload_data_lainnya();" ><i class="fa fa-refresh"></i> Refresh</a>
            </div>
        </div>
    </div>
    <div class="card-body p-1">
        <div id="dataview_lainnya" class="bg-light rounded"></div>
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

<script type="text/javascript">
setTimeout("reload_data_jurnal()",1);
setTimeout("reload_data_buku()",150);
setTimeout("reload_data_seminar()",300);
setTimeout("reload_data_lainnya()",450);

/* INDEX PUBLIKASI ILMIAH */
function reload_data_jurnal(url){
    var id_penelitian=$("#id_penelitian").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('capaian_jurnal/capaian_jurnal_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row=3&id_penelitian="+id_penelitian,
		beforeSend	: function(){
						$("#ajax_jurnal").fadeIn();
		},
		success   	: function(data){
						$("#ajax_jurnal").fadeOut(1000);
						$("#dataview_jurnal").hide().html(data).fadeIn(800);
		}
	});///end of ajax
}

$("#add_jurnal").click(function(){
    var id_penelitian=$("#id_penelitian").val();
	$.ajax({
			url       : "<?php echo site_url('capaian_jurnal/capaian_jurnal_add');?>/"+id_penelitian,
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn();
			},
			success   : function(data){
						$("#ajax_loader").fadeOut();
						$("#modalTitle").html("<h4>Tambah Data Publikasi Ilmiah</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});

/* INDEX BUKU AJAR */
function reload_data_buku(url){
    var id_penelitian=$("#id_penelitian").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('capaian_buku/capaian_buku_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row=3&id_penelitian="+id_penelitian,
		beforeSend	: function(){
						$("#ajax_buku").fadeIn();
		},
		success   	: function(data){
						$("#ajax_buku").fadeOut(1000);
						$("#dataview_buku").hide().html(data).fadeIn(800);
		}
	});///end of ajax
}

$("#add_buku").click(function(){
    var id_penelitian=$("#id_penelitian").val();
	$.ajax({
			url       : "<?php echo site_url('capaian_buku/capaian_buku_add');?>/"+id_penelitian,
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#ajax_loader").fadeOut(100);
						$("#modalTitle").html("<h4>Tambah Data Buku Ajar</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});

/* index seminar */
function reload_data_seminar(url){
    var id_penelitian=$("#id_penelitian").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('capaian_seminar/capaian_seminar_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row=3&id_penelitian="+id_penelitian,
		beforeSend	: function(){
						$("#ajax_seminar").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_seminar").fadeOut(100);
						$("#dataview_seminar").hide().html(data).fadeIn(800);
		}
	});///end of ajax
}

$("#add_seminar").click(function(){
    var id_penelitian=$("#id_penelitian").val();
	$.ajax({
			url       : "<?php echo site_url('capaian_seminar/capaian_seminar_add');?>/"+id_penelitian,
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#ajax_loader").fadeOut(100);
						$("#modalTitle").html("<h4>Tambah Data Pembicara pada Pertemuan Ilmiah (Seminar/Simposim)</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});

/* INDEX CAPAAIN LAINNYA */
function reload_data_lainnya(url){
	var id_penelitian=$("#id_penelitian").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('capaian_lain/capaian_lain_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row=3&id_penelitian="+id_penelitian,
		beforeSend	: function(){
						$("#ajax_lainnya").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_lainnya").fadeOut(100);
						$("#dataview_lainnya").hide().html(data).fadeIn(800);
		}
	});///end of ajax
}

$("#add_lainya").click(function(){
    var id_penelitian=$("#id_penelitian").val();
	$.ajax({
			url       : "<?php echo site_url('capaian_lain/capaian_lain_add');?>/"+id_penelitian,
			dataType  : "html",
			beforeSend: function(){
						  $("#ajax_loader").fadeIn(100);
			},
			success   : function(data){
						$("#ajax_loader").fadeOut(100);
						$("#modalTitle").html("<h4>Tambah Data Capaian Lainnya</h4>");
						$("#dataview_modal").html(data);
						$("#modalView").modal("show");
			}
		});
});
</script>
