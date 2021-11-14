<div class="card mb-2">
    <div class="card-body py-0 px-2">
		<div class="row my-2">
			<div class="col-sm-12 col-md-12">
		      <div class="input-group">
		         <input type="text" name="tb_filter" id="tb_filter" class="form-control form-control-lg border-right-0 border" placeholder="Pencarian berita" onkeyup="switch_icon();">
		         <span class="input-group-append" id="icon_search">
		            <div class="input-group-text bg-transparent" style="color:#e8e8e8;"><i class="fa fa-search fa-2x"></i></div>
		         </span>
		      </div>
			</div>
		</div>
	</div>
</div>

<div class="card mb-3">
    <div class="card-body">
		<div id="alert_info"></div>
		<div id="dataview" ></div>
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
        $("#icon_search").html('<div class="input-group-text bg-transparent" style="color:#e8e8e8;"><i class="fa fa-search fa-2x"></i></div>');
    }else{
        $("#icon_search").html('<div style="cursor:pointer;color:#af9a89;" onclick="switch_icon(\'TRUE\');" class="input-group-text bg-transparent"><i class="fa fa-remove fa-2x"></i></div>');
    }
    reload_data();
};

function reload_data(url){
	var cari=$("#tb_filter").val();
	if(url == null || url == undefined){
		seturl="<?php echo site_url('main/berita');?>/0";
	}else{
		seturl=url;
	};
	$.ajax({
		url          : seturl,
		type         : "POST",
		dataType     : "html",
		data         : "cari="+cari,
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
