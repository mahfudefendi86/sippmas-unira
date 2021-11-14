<fieldset>
<legend><h3>UBAH PASSWORD</h3></legend>
<?php
if(isset($info)){
	echo $info;
}else{
?>
<form  id="ganti_password" method="post" action="<?php echo site_url('util/simpan_password');?>">
<input type="hidden" name="id" id="id" value="<?php echo $this->session->userdata('id_user');?>" />
			<div class="form-group">
				<label class="col-sm-12 col-md-3" for="p1">Password Lama Anda</label>
				<div class="col-sm-12 col-md-9">
				  <input type="password" name="p1" id="p1" class="form-control" value="" placeholder="Masukkan Password Lama" />
				</div>
          </div><br />
<br />

          <div class="form-group">
				<label class="col-sm-12 col-md-3" for="p2">Password Baru Anda</label>
				<div class="col-sm-12 col-md-9">
				  <input type="password" name="p2" id="p2" class="form-control" value="" placeholder="Masukkan Password Baru" />
				</div>
          </div>
          <div class="form-group">
				<label class="col-sm-12 col-md-3" for="p3">Password Konfirmasi</label>
				<div class="col-sm-12 col-md-9">
				  <input type="password" name="p3" id="p3" class="form-control" value="" placeholder="Masukkan Password Baru" />
				</div>
          </div>
          <br />
          <div class="form-group">
          <label class="col-sm-12 col-md-3" for="p3"></label>
				<div class="col-sm-12 col-md-9">
                			<p><?php echo $image;?></p>
				</div>
          </div>
           <div class="form-group">
				<label class="col-sm-12 col-md-3" for="p3">Masukan Kode Diatas</label>
				<div class="col-sm-12 col-md-9">
				  <input type="text" name="security_code" id="security_code"  value="" class="inputan form-control" placeholder="Masukkan Kode Diatas" />
                </div>
          </div><br />

			<div class="form-group">
            	<label class="col-sm-12 col-md-3" for="p3"></label>
				<div class="col-sm-12 col-md-9">
					<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
		</form>
  <?php
  }

  ?>
</fieldset>
