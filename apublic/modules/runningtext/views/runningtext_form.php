<?php
$is_edit=(isset($runningtext));
?>
<div class="card p-3 mb-3">
	<form class="form-horizontal" role="form" name="formrunningtext" id="runningtext" action="<?php echo (!$is_edit) ? site_url("runningtext/runningtext_add") : site_url("runningtext/runningtext_upd").'/'.$runningtext->id_running;?>" method="post" >
<input type="hidden" class="form-control" value="<?php echo (!$is_edit) ? '' : $runningtext->id_running;?>" name="rt_id_running" id="rt_id_running" placeholder="id_running"   />
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="rt_mulai">Mulai Tangal</label>
					<div class="col-sm-12 col-md-9">
						<div class="input-group date">
							<div class="input-group-addon input-group-prepend">
							    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
							</div>
						  <input type="text" class="form-control"  value="<?php echo (!$is_edit) ? '' : $runningtext->start_date;?>" name="rt_mulai" id="rt_mulai" placeholder="Mulai tanggal"  >
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="rt_sampai">Sampai Tanggal</label>
					<div class="col-sm-12 col-md-9">
						<div class="input-group date">
							<div class="input-group-addon input-group-prepend">
							    	<span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
							</div>
						  <input type="text" class="form-control"  value="<?php echo (!$is_edit) ? '' : $runningtext->end_date;?>" name="rt_sampai" id="rt_sampai" placeholder="Sampai tanggal"  >
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="kg_ikon">Ikon</label>
					<div class="col-sm-12 col-md-9">
						<div class="row">
							<div class="col-1">
								<div id="iconBox"  class="btn btn-warning mr-1 mb-2 p-1" style="width:40px;height:35px;" >
									<?php
									$iko=((!$is_edit) ? '' : $runningtext->icon_run);
									if($iko!=""){
										echo '<i class="'.$iko.'"></i>';
									}else{
										echo '<span class="h4">?</span>';
									}
									?>
								</div>
							</div>
							<div class="col-11">
								<input type="text" readonly class="form-control" value="<?php echo (!$is_edit) ? '' : $runningtext->icon_run;?>" name="kg_ikon" id="kg_ikon" placeholder="Nama Ikon"   />
								<div class="card clearboth" id="panel_icon" style="display:none; position:absolute;top:0px; left:-33px;z-index:100;">
									<div class="card-body">
										<div class="row">
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-bullhorn"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-bell-o"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-folder-open-o"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-warning"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-clipboard"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-cloud-upload"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-coffee"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-clock-o"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-edit"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-envelope"></i></button>
										</div>
										<div class="row">
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-exclamation-circle"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-check-circle"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-flag-o"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-gavel"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-gift"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-graduation-cap"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-tags"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-heart"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-info-circle"></i></button>
											<button type="button" class="btn_icon col btn btn-outline-secondary mr-1 mb-2" ><i class="fa fa-history"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="kg_warana">Warna Text</label>
					<div class="col-sm-12 col-md-9">
						<div class="row">
							<div class="col-1">
								<?php
									$warna="";
									$c=(!$is_edit) ? '' : $runningtext->color_teks;
									if($c!="" || $c!=NULL){
										$warna=$c;
									}
								?>
								<div id="cpicker" class="Box transpa" style="background:<?php echo $warna;?>; border:1px solid #d5d5d5;cursor:pointer;" ></div>
							</div>
							<div class="col-11">
								<input type="text" class="form-control" value="<?php echo (!$is_edit) ? '' : $runningtext->color_teks;?>" name="kg_warana" id="kg_warana" placeholder="Warna text"   />
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="rt_informasi">Text to run</label>
					<div class="col-sm-12 col-md-9">
						<textarea name="rt_informasi" id="rt_informasi"   class="form-control" placeholder="Ketik informasi disini > maksimal 150 karakter" ><?php echo (!$is_edit) ? '' : $runningtext->text_to_run;?></textarea>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-12 col-md-3" for="rt_">Status</label>
					<div class="col-sm-12 col-md-9">
						<select name="rt_status" id="rt_status" class="custom-select" >
							<?php $st=array('Y'=>"Run",'N'=>"Stop");
							foreach ($st as $key => $value) {
								if($st==((!$is_edit) ? '' : $runningtext->status_run)){
									echo '<option value="'.$key.'" selected>'.$value.'</option>';
								}else{
									echo '<option value="'.$key.'">'.$value.'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>

<hr/>
		<div class="form-group row">
			<div class="col-sm-12 col-md-12">
				<div class="row justify-content-md-center">
					<button type="submit" class="btn btn-primary btn-lg col-3 mx-2"><span class="fa fa-save"></span> Simpan</button>
					<button type="reset" class="btn btn-warning btn-lg col-3 mx-2" onclick="$('#modalView').modal('hide');"><span class="fa fa-refresh"></span> Batal</button>
				</div>
			</div>
		</div>

</form>
</div>
<!--  COLOR PICKER -->
<link href="<?php echo base_url();?>asset/addon/colorpicker/wColorPicker.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/addon/colorpicker/lib/rgbHex.min.js"></script>
<script src="<?php echo base_url();?>asset/addon/colorpicker/wColorPicker.min.js"></script>

<script>
	$("#cpicker").wColorPicker({
	  theme           : 'black',
	  mode			  : 'click',
	  opacity         : 1,
	  effect          : 'fade',
      generateButton:false,
      dropperButton: true,
      onSelect: function(color) {
        $("#cpicker").removeClass("transpa").css('backgroundColor', color);
		$("#kg_warana").val(color);
      },
      onDropper: function() {
        alert(this.options.color);
      }
   });

</script>
<style>
.transpa{
	background-image: url(<?php echo base_url();?>asset/images/trans.png);
}
.wColorPicker, .wColorPicker-holder{
	width: 317px; height: 240px!important;
}
.wColorPicker-palette-color{
	width: 15px!important;height: 15px!important;
}
.Box{
position: relative;
float:left;
margin: 0px 10px 10px 0;
width: 40px;
height: 35px;
border: 0px;
}
</style>
<!--  END COLOR PIKCER -->

<!-- SELECT IKON -->
<script>
$("#iconBox").click(function(){
	$("#panel_icon").fadeIn(300);
})
$(".btn_icon").click(function(){
	var ikon=$(this).find("i").attr("class");
	$("#kg_ikon").val(ikon);
	$("#iconBox").html($(this).html());
	$("#panel_icon").fadeOut(300);
});
</script>
<script src="<?php echo base_url();?>asset/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript">
 $("#runningtext").validate({
 			errorClass: "is-invalid",
			validClass: "is-valid",
			wrapper: "span",
	  		rules:{
				rt_mulai: { required: true },
				rt_sampai: { required: true },
				rt_informasi: { required: true }
 			 },
			messages:{
	 			rt_mulai: "Tanggal mulai berjalan wajib diisi....",
	 			rt_sampai: "Batas tanggal berjalan wajib diisi....",
	 			rt_informasi:"Informasi text wajib diisi...."
  			 },

		  	submitHandler: function() {
				var frm=$("#runningtext");
				$.ajax({
					url       : frm.attr("action"),
					type      : frm.attr("method"),
					dataType  : "html",
					data      : frm.serialize(),
					beforeSend: function(){
							///Event sebelum proses data dikirim
							$("#ajax_loader").fadeIn(100);
					},
					success   : function(data){
							///Event Jika data Berhasil diterima
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_data();
							}else
							if(obj.status=="ERROR"){
								$("#alert_info").html(obj.msg);
							}
							$("#modalView").modal("hide");
							$("#ajax_loader").fadeOut(100);
					}
				});///end Of Ajax
		 }
	 });
</script>
<!--  LOADING DATEPICKER -->
<link href="<?php echo base_url();?>asset/addon/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>asset/addon/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>asset/addon/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
<script>
$('.input-group.date').datepicker({
    maxViewMode: 2,
    language: "id",
    autoclose: true,
    toggleActive: true,
	format:"yyyy-mm-dd"
});
</script>
<!--  END DATA PICKER LOADING-->
