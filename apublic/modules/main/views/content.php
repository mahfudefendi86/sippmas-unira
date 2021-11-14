<h4 class="text-primary mb-3">DASHBOARD <span class="text-danger">[Sistem Informasi Penelitian dan Pengabdian Masyarakat]</span></h4>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                Selamat Datang, <span class="h5"><?php echo $this->session->userdata('nama');?></span>
            </div>
            <div class="card-body">
                <p>Ini adalah halaman dashboard anda. Dihalaman dashboard ini anda diberikan jalan pintas untuk melakukan aktivitas</p>
            </div>
        </div>
    </div>
    <?php if($this->session->userdata('akses')=="ADM" || $this->session->userdata('akses')=="SUA"){ ?>
    <!-- Icon Cards-->
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-comments"></i>
            </div>
            <div class="mr-5"><?php echo isset($num_berita)?$num_berita->jumlah:"0";?> Berita Baru!</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('berita');?>">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-sitemap"></i>
            </div>
            <div class="mr-5"><?php echo isset($num_kategori)?$num_kategori->jumlah:"0";?> Kategori Berita</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('kategori/');?>">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?php echo isset($num_usulan)?$num_usulan->jumlah:"0";?> Pengajuan Judul!</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('penelitian/show/');?>">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-fw fa-user-circle"></i>
            </div>
            <div class="mr-5"><?php echo isset($num_peneliti)?$num_peneliti->jumlah:"0";?> Author</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('peneliti/');?>">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

    <!-- END Icon Cards-->
<?php };?>

    <div class="col-md-12">
      <div class="row">
        <div class="<?php echo ($this->session->userdata("akses")=="ADM" || $this->session->userdata("akses")=="SUA")?"col-md-12":"col-md-7";?> col-sm-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="title">Menu Shortcut</h4>
                    <div class="clearfix"></div>
                    <div class="row">
                        <?php if($this->session->userdata("akses")=="SUA" || $this->session->userdata("akses")=="ADM"){ ;?>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('konfigurasi/');?>" title="Konfigurasi Usulan" class="text-success">
                                <i class="fa fa-gears fa-3x"></i>
                                <p class="shc_judul">Konfigurasi Usulan</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('status_aktif/');?>" title="Konfigurasi Status Pengajuan" class="text-warning">
                                <i class="fa fa-flag fa-3x"></i>
                                <p class="shc_judul">Konfigurasi Status Pengajuan</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('userlogin/');?>" title="Daftar Userlogin" class="text-secondary">
                                <i class="fa fa-lock fa-3x"></i>
                                <p class="shc_judul">Daftar Userlogin</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('berita/berita_add/');?>" title="Tambah Berita/Artikel" class="text-danger">
                                <i class="fa fa-newspaper-o fa-3x"></i>
                                <p class="shc_judul">Tambah Berita/Artikel</p>
                            </a>
                        </div>
                        <?php };?>

                        <?php if($this->session->userdata("akses")=="SUA" || $this->session->userdata("akses")=="ADM" || $this->session->userdata("akses")=="PENELITI"){ ;?>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/penelitian_add/');?>" title="Pengajuan Baru" class="text-primary" >
                                <i class="fa fa-send-o fa-3x"></i>
                                <p class="shc_judul">Tambah Usulan Baru</p>
                            </a>
                        </div>
                                <?php if($this->session->userdata("akses")=="PENELITI"){ ;?>
                                    <div class="col-sm-6 col-md-3 text-center shc mb-4">
                                        <a href="<?php echo site_url('penelitian/riwayat_ketua/');?>" title="Riwayat Ketua" class="text-danger" >
                                            <i class="fa fa-user fa-3x"></i>
                                            <p class="shc_judul">Riwayat Ketua</p>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-3 text-center shc mb-4">
                                        <a href="<?php echo site_url('penelitian/riwayat_anggota/');?>" title="Riwayat Anggota" class="text-info">
                                            <i class="fa fa-users fa-3x"></i>
                                            <p class="shc_judul">Riwayat Anggota</p>
                                        </a>
                                    </div>
                                <?php };?>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/catatan/');?>" title="Catatan Harian" class="text-success">
                                <i class="fa fa-edit fa-3x"></i>
                                <p class="shc_judul">Catatan Harian</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/kemajuan/');?>" title="Laporan Kemajuan" class="text-muted">
                                <i class="fa fa-line-chart fa-3x"></i>
                                <p class="shc_judul">Laporan Kemajuan</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/akhir/');?>" title="Laporan Akhir" class="text-warning">
                                <i class="fa fa-bar-chart fa-3x"></i>
                                <p class="shc_judul">Laporan Akhir</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/tanggung_jawab_belanja/');?>" title="Tanggung Jawab Belanja" class="text-danger">
                                <i class="fa fa-money fa-3x"></i>
                                <p class="shc_judul">Tanggung Jawab Belanja</p>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center shc mb-4">
                            <a href="<?php echo site_url('penelitian/seminar_hasil/');?>" title="Berkas Seminar" class="text-primary">
                                <i class="fa fa-folder fa-3x"></i>
                                <p class="shc_judul">Berkas Seminar</p>
                            </a>
                        </div>
                        <?php };?>
                        <?php if($this->session->userdata("akses")=="REVIEWER"){ ;?>
                            <div class="col-sm-6 col-md-3 text-center shc mb-4">
                                <a href="<?php echo site_url('penelitian/nilairev/input/');?>" title="Input Nilai" class="text-success" >
                                    <i class="fa fa-edit fa-3x"></i>
                                    <p class="shc_judul">Input Nilai</p>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3 text-center shc mb-4">
                                <a href="<?php echo site_url('penelitian/seminar_hasil/');?>" title="Berkas Seminar Hasil" class="text-info">
                                    <i class="fa fa-list fa-3x"></i>
                                    <p class="shc_judul">Berkas Seminar Hasil</p>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3 text-center shc mb-4">
                                <a href="<?php echo site_url('reviewer/reviewer_profil_show/');?>" title="Update Profil" class="text-info">
                                    <i class="fa fa-user fa-3x"></i>
                                    <p class="shc_judul">Update Profil</p>
                                </a>
                            </div>
                        <?php };?>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOTCUT -->
        <?php if(isset($user) && $user!=NULL){ ;?>
        <div class="col-md-5 col-sm-12  mb-3">
            <ul class="list-group">
              <li class="list-group-item <?php echo ($this->session->userdata('akses')=="PENELITI")?"bg-success  text-white ":"bg-warning";?> p-1 pl-3">
                  <a href="<?php echo base_url().$user->foto;?>" data-fancybox="group" title="<?php echo $user->nama;?>">
          			<div class="fill float-right rounded border border-light" style="width:70px; height:80px">
          	  			<img  src="<?php echo base_url().$user->foto_thumb;?>" alt="foto of <?php echo $user->nama;?>"/>
          			</div>
          		 </a>
                  <p class="h5 my-0 pt-1"><?php echo $user->nama;?></p>
                  <p><?php echo $user->email;?><br/>
                  <?php echo $this->session->userdata('akses');?></p>
              </li>
              <li class="list-group-item pb-1"><p class="mb-1 text-medium text-primary">NIDN</p><p class="text-muted"><?php echo $user->nidn;?></p></li>
              <li class="list-group-item pb-1"><p class="mb-1 text-medium text-primary">FAKULTAS</p><p class="text-muted"><?php echo $user->nama_fakultas;?></p></li>
              <li class="list-group-item pb-1"><p class="mb-1 text-medium text-primary">PROGRAM STUDI</p><p class="text-muted"><?php echo $user->nama_prodi;?></p></li>
              <li class="list-group-item pb-1"><p class="mb-1 text-medium text-primary">STATUS AKTIVASI</p><p class="text-muted"><?php echo $this->session->userdata("status");?></p></li>
            </ul>
        </div>
    <?php };?>
    <!-- END SHORTCUT -->
      </div>
    </div>

</div>
<!--  LOADING FANCYBOX-->
<script src="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.js"></script>
<link href="<?php echo base_url();?>asset/addon/fancybox/jquery.fancybox.css" rel="stylesheet" />
<!-- END FABCYBOX -->
