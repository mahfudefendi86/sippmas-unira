<div class="row">
   <div class="col-sm-12 col-md-7">
      <h3 id="title" class="border-bottom border-primary text-primary pb-2" ><?php echo $title;?></h3>
   </div>
   <div class="col-sm-12 col-md-5">
      <div class="float-md-right">
         <a id="refresh" title="Refresh" onclick="window.location.reload();" ><button class="btn btn-info btn-sm ml-2 my-1"><span class="fa fa-refresh"></span> Refresh</button></a>
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

	<div class="col-sm-12 col-md-8 mb-1">
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
	if(url == null || url == undefined){
		seturl="<?php echo site_url('konfigurasi/konfigurasi_show');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "row="+row+"&filter="+filter+"&cari="+cari,
		beforeSend	: function(){
						$("#ajax_loader").fadeIn(100);
		},
		success   	: function(data){
						$("#ajax_loader").fadeOut(100);
						$("#dataview").html(data);
		}
	});///end of ajax
}


</script>
