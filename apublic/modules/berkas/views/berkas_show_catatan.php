<table class="table table-sm table-hover">
	<th width="6%">No.</th>
	<th width="50%">Nama File</th>
	<th width="30%">Keterangan</th>
	<th width="13%">Action</th>
</tr>
	</thead>
<tbody>
<?php
(isset($start))?$no=$start:$no=0;
if(count($berkas)>0){
	foreach($berkas as $dataview){
		$no++;
;?>
<tr id="tr_<?php echo $dataview->id_berkas;?>"  style="background:<?php echo ($no%2==0)?'#f4f6f9':'';?>">
	<td class="text-center"><?php echo $no;?></td>
	<td><?php
	$t=explode(" ",$dataview->tanggal_upload);
	echo $dataview->file_name;
	echo '<br/><span class="mt-1 text-muted text-medium"><i class="fa fa-calendar"></i> &nbsp;'.tgl_indo($t[0]).' '.$t[1].'</span>';
	?></td>
	<td><?php echo $dataview->keterangan_berkas;?></td>
	<td>
		<a href="<?php echo site_url("berkas/unduh/".$dataview->id_berkas);?>" class="unduh btn btn-sm btn-success stooltip" title="Unduh berkas" target="_blank"><i class="fa fa-download"></i></a>
		<button type="button" class="delete btn btn-sm btn-danger stooltip" rel="<?php echo $dataview->id_berkas;?>" notes="<?php echo $dataview->identifikasi_id;?>"  title="Delete Data"><i class="fa fa-trash"></i></button>
	</td>
</tr>
<?php }
}else {
	echo '<tr><td colspan="4" align="center"><i class="fa fa-exclamation-circle"></i> Belum ada berkas....</td></tr>';
};?>
</tbody>

</table>

<script type="text/javascript">
$(document).ready(function(){
	$('.stooltip').tooltip();

	$("#count_berkas_<?php echo $id_catatan;?>").html('(<?php echo $jumlah_berkas;?>)');

	$(".delete").click(function(){
		var id=$(this).attr("rel");
		var id_catatan=$(this).attr("notes");
		if(confirm("Apakah anda yakin akan menghapus data ?")==true){
			$.ajax({
				url       : "<?php echo site_url('berkas/berkas_dlt');?>/"+id,
				dataType  : "html",
				beforeSend: function(){
							  $("#ajax_loader").fadeIn(100);
				},
				success   : function(data){
							obj = JSON.parse(data);
							if(obj.status=="OK"){
								$("#alert_info").html(obj.msg);
								reload_berkas(id_catatan);
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
