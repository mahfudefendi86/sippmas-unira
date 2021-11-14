<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="row justify-content-md-center">
         <a id="add" title="Tambah Daftar Peserta Kkn" ><button class="btn btn-primary btn-sm ml-3 my-1"><span class="fa fa-plus"></span> Tambah Data</button></a>
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-info btn-sm ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
      </div>
   </div>
</div>
<div class="row my-2">
	<div class="col-md-4 col-sm-12 mb-1">
      <div class="input-group input-group-sm mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Tampil</div>
        </div>
         <select name="slct_row" id="slct_row" class="form-control custom-control-sm" onchange="reload_data_peserta_kkn();">
   			<option value="5">5 baris</option>
   			<option value="10">10 baris</option>
   			<option value="15">15 baris</option>
   			<option value="25" selected>25 baris</option>
   			<option value="50">50 baris</option>
   			<option value="75">75 baris</option>
   			<option value="100">100 baris</option>
   		</select>
      </div>
	</div>

	<div class="col-md-4 col-sm-12 mb-1">
		<select name="slct_filter" id="slct_filter" class="custom-control form-control-sm custom-select">
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
      <div class="input-group input-group-sm">
         <input type="text" name="tb_filter" id="tb_filter" class="form-control border-right-0 border" placeholder="Kata Kunci Pencarian" onkeyup="switch_icon();">
         <span class="input-group-append" id="icon_search">
            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
         </span>
      </div>
	</div>
</div>
<div id="alert_info"></div>
<div id="dataview" ></div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal label" aria-hidden="true" id="modalView_peserta_kkn" data-backdrop="static">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
		 <div class="modal-header">
			<h5 class="modal-title" id="modalTitle_peserta_kkn">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div id="dataview_modal_peserta_kkn"></div>
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
setTimeout("reload_data_peserta_kkn();",1);

var linkPage="<?php echo site_url('peserta_kkn/peserta_kkn_show');?>/0";
function updateLinkPage(nLink){
    linkPage=nLink;
    reload_data_peserta_kkn();
}

var sort_index="ASC";
var sort_field="";

function sorted(by){
	sort_field=by;
	if(sort_index=="ASC"){ sort_index="DESC"; }else{ sort_index="ASC"; }
	reload_data_peserta_kkn();
}

function iconsorter(){
	if(sort_index!="" && sort_index=='ASC'){
		$("th.sort[data-field='"+sort_field+"']").append(' <i class="fa fa-sort-amount-asc"></i>');
	}else if(sort_index!="" && sort_index=='DESC'){
		$("th.sort[data-field='"+sort_field+"']").append(' <i class="fa fa-sort-amount-desc"></i>');
	}
}

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
	if(i.length >= 2 || i.length==0){
	    reload_data_peserta_kkn();
	}
};

function reload_data_peserta_kkn(url){
	var row=$("#slct_row").val();
	var cari=$("#tb_filter").val();
	var filter=$("#slct_filter").val();
	if(url == null || url == undefined){
		seturl=linkPage;
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		headers		 : {'X-Requested-With': 'XMLHttpRequest'},
		dataType     : "html",
		data         : "row="+row+"&filter="+filter+"&cari="+cari+"&sortby="+sort_field+"&sort="+sort_index,
		beforeSend	: function(){
						$("#ajax_loader").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_loader").fadeOut(100);
						$("#dataview").html(data);
						iconsorter();
		}
	});///end of ajax
}

$("#add").click(function(){
	$.ajax({
		url       : "<?php echo site_url('peserta_kkn/peserta_kkn_add');?>",
		dataType  : "html",
		headers	  : {'X-Requested-With': 'XMLHttpRequest'},
		beforeSend: function(){
					  $("#ajax_loader").fadeIn(100);
		},
		success   : function(data){
					$("#ajax_loader").fadeOut(100);
					$("#modalTitle_peserta_kkn").html("<h4>Tambah Data Peserta Kkn</h4>");
					$("#dataview_modal_peserta_kkn").html(data);
					$("#modalView_peserta_kkn").modal("show");
		}
	});/* End of Ajax */
});

</script>