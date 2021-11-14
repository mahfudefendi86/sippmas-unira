<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" style="max-width:220px; width:220px;" href="<?php echo base_url();?>">SIPP Mas
  <?php
$sph=$this->session->userdata("akses");
if($sph=="SUA"){ echo '<span class="ml-2 p-1 text-small badge badge-pill badge-danger">Super Admin</span>';}else
if($sph=="ADM"){ echo '<span class="ml-2 p-1 text-small badge badge-pill badge-success">Administrator</span>';}else
if($sph=="REVIEWER"){ echo '<span class="ml-2 p-1 text-small badge badge-pill badge-primary">Reviewer</span>';}else
if($sph=="PENELITI"){ echo '<span class="ml-2 p-1 text-small badge badge-pill badge-warning">Author</span>';}
;?>
</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive" >
    <ul class="navbar-nav navbar-sidenav" id="MenuAccordion" style="overflow-y:auto;" >

      <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Dashboard">
         <a class="nav-link" href="<?php echo site_url('main/dashboard');?>">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
         </a>
      </li>
      <!-- CEK LEVEL ADMIN /SUPER ADMIN -->
      <?php if($this->session->userdata('akses')=="SUA" || $this->session->userdata('akses')=="ADM"){ ;?>
      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#master_data" data-parent="#MenuAccordion" >
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Master Data</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="master")?"show ":"";?>" id="master_data">
          <li>
            <a href="<?php echo site_url('peneliti');?>">Data Dosen/Author</a>
          </li>
          <li>
            <a href="<?php echo site_url('reviewer');?>">Data Reviewer</a>
          </li>
          <li>
            <a href="<?php echo site_url('fakultas');?>">Data Fakultas</a>
          </li>
          <li>
            <a href="<?php echo site_url('prodi');?>">Data Prodi</a>
          </li>
          <li>
            <a href="<?php echo site_url('keahlian');?>">Data Bidang Keahlian</a>
          </li>
          <li>
            <a href="<?php echo site_url('bidang_ilmu');?>">Data Bidang Ilmu</a>
          </li>
          <li>
            <a href="<?php echo site_url('anggaran');?>">Tahun Anggaran</a>
          </li>
          <li>
            <a href="<?php echo site_url('skema');?>">Daftar Skema</a>
          </li>
        </ul>
      </li>

      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#usulan" data-parent="#MenuAccordion">
          <i class="fa fa-feed"></i>
          <span class="nav-link-text">Pengajuan</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="usulan")?"show":"";?>" id="usulan">
          <li>
            <a href="<?php echo site_url('penelitian/show/');?>"><i class="fa fa-chain"></i> Daftar Pengajuan </a>
          </li>
          <li>
            <a href="<?php echo site_url('penelitian/show/disetujui/');?>"><i class="fa fa-chain"></i> Daftar Pengajuan Didanai</a>
          </li>
        </ul>
      </li>

      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#reviewer" data-parent="#MenuAccordion">
          <i class="fa fa-edit"></i>
          <span class="nav-link-text">Penilaian Reviewer</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="reviewer")?"show":"";?>" id="reviewer">
            <li>
                <a href="<?php echo site_url('reviewer/daftar');?>"><i class="fa fa-chain"></i> Daftar Reviewer</a>
            </li>
              <li>
                <a href="<?php echo site_url('penelitian/ploting/');?>"><i class="fa fa-chain"></i> Plotting Reviewer</a>
              </li>
              <li>
                <a href="<?php echo site_url('penelitian/hasilnilairev/');?>"><i class="fa fa-chain"></i> Hasil Review & Upload SK</a>
              </li>
              <!-- <li>
                <a href="<?php echo site_url('penelitian/show/disetujui');?>"><i class="fa fa-chain"></i> Penelitian Disetujui</a>
              </li> -->

        </ul>
      </li>

      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#pengabdian" data-parent="#MenuAccordion">
          <i class="fa fa-fw fa-support"></i>
          <span class="nav-link-text">Pemantauan Pelaksanaan</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="pelaksanaan")?"show":"";?>" id="pengabdian">
            <li ><a href="<?php echo site_url('penelitian/catatan/');?>">Catatan Harian</a></li>
            <li ><a href="<?php echo site_url('penelitian/kemajuan/');?>">Laporan Kemajuan</a></li>
            <li ><a href="<?php echo site_url('penelitian/akhir/');?>">Laporan Akhir</a></li>
            <li ><a href="<?php echo site_url('penelitian/tanggung_jawab_belanja/');?>">Tanggung jawab Belanja</a></li>
            <li ><a href="<?php echo site_url('penelitian/seminar_hasil/');?>">Berkas Seminar Hasil</a></li>
        </ul>
      </li>

      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Konfigurasi" data-parent="#MenuAccordion">
          <i class="fa fa-fw fa-cogs"></i>
          <span class="nav-link-text">Konfigurasi</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="Konfigurasi")?"show":"";?> " id="Konfigurasi">
          <li>
            <a href="<?php echo site_url('konfigurasi');?>">Konfigurasi Pengajuan </a>
          </li>
          <li>
            <a href="<?php echo site_url('status_aktif');?>">Status Non Aktif Author</a>
          </li>
          <li>
            <a href="<?php echo site_url('userlogin');?>">Userlogin</a>
          </li>
        </ul>
      </li>


      <li class="nav-item" >
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#berita" data-parent="#MenuAccordion">
          <i class="fa fa-fw fa-archive"></i>
          <span class="nav-link-text">Berita/Artikel</span>
        </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="berita")?"show":"";?> " id="berita">
          <li>
            <a href="<?php echo site_url('kategori');?>">Kategori Berita</a>
          </li>
          <li>
            <a href="<?php echo site_url('berita');?>">Tambah Berita</a>
          </li>
          <li>
            <a href="<?php echo site_url('slideshow');?>">Slideshow</a>
          </li>
          <li>
            <a href="<?php echo site_url('runningtext');?>">Running Text</a>
          </li>
        </ul>
      </li>
  <?php };?>
    <!-- END CEK LEVEl ADMIN /SUPER ADMIN -->

    <!-- CEK LEVEL PENELITI -->
   <?php if($this->session->userdata('akses')=="PENELITI"){ ;?>
   <?php
    /* CEK KONDISI LINK YANG AKTIF PADA PENELITIAN */
    $u_penelitian=$this->uri->slash_segment(2);
    ?>
  <li class="nav-item" >
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#baru" data-parent="#MenuAccordion">
      <i class="fa fa-check-circle"></i>
      <span class="nav-link-text">Usulan Baru</span>
    </a>
        <ul class="sidenav-second-level collapse  <?php echo ($this->session->tempdata('active_link')=="usulan")?"show ":"";?>" id="baru">
              <li <?php echo ($u_penelitian=="show/")?'class="aktif"':'';?>>
                <a href="<?php echo site_url('penelitian/show/');?>"><i class="fa fa-plus"></i> Usulan Baru </a>
              </li>
              <li <?php echo ($u_penelitian=="show/")?'class="aktif"':'';?>>
                <a href="<?php echo site_url('penelitian/show/disetujui');?>"><i class="fa fa-usd"></i> Usulan Disetujui </a>
             </li>
        </ul>
    </li>
    <li class="nav-item" >
      <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Pelaksanaan" data-parent="#MenuAccordion">
        <i class="fa fa-fw fa-gears"></i>
        <span class="nav-link-text">Pelaksanaan Kegiatan</span>
      </a>
        <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="pelaksanaan")?"show ":"";?>" id="Pelaksanaan">
              <li <?php echo ($u_penelitian=="catatan/")?'class="aktif"':'';?>><a href="<?php echo site_url('penelitian/catatan/');?>">Catatan Harian</a></li>
              <li <?php echo ($u_penelitian=="kemajuan/")?'class="aktif"':'';?>><a href="<?php echo site_url('penelitian/kemajuan/');?>">Laporan Kemajuan</a></li>
              <li <?php echo ($u_penelitian=="akhir/")?'class="aktif"':'';?>><a href="<?php echo site_url('penelitian/akhir/');?>">Laporan Akhir</a></li>
              <li <?php echo ($u_penelitian=="tanggung_jawab_belanja/")?'class="aktif"':'';?>><a href="<?php echo site_url('penelitian/tanggung_jawab_belanja/');?>">Tanggung jawab Belanja</a></li>
              <li <?php echo ($u_penelitian=="seminar_hasil/")?'class="aktif"':'';?>><a href="<?php echo site_url('penelitian/seminar_hasil/');?>">Berkas Seminar Hasil</a></li>
        </ul>
  </li>
  <li class="nav-item" >
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#riwayat" data-parent="#MenuAccordion">
      <i class="fa fa-fw fa-clock-o"></i>
      <span class="nav-link-text">Riwayat</span>
    </a>
      <ul class="sidenav-second-level collapse <?php echo ($this->session->tempdata('active_link')=="riwayat")?"show ":"";?>" id="riwayat">
            <li ><a href="<?php echo site_url('penelitian/riwayat_ketua');?>">Sebagai Ketua</a></li>
            <li ><a href="<?php echo site_url('penelitian/riwayat_anggota');?>">Sebagai Anggota</a></li>
      </ul>
</li>

<?php };?>
  <!--  END CEK LEVEL PENELITI -->


<!-- CEK LEVEL Reviewer -->
<?php if($this->session->userdata('akses')=="REVIEWER"){ ;?>
  <li class="nav-item" >
     <a class="nav-link" href="<?php echo site_url('penelitian/nilairev/input');?>">
      <i class="fa fa-edit"></i>
      <span class="nav-link-text">Input Nilai</span>
     </a>
  </li>
  <li class="nav-item" >
     <a class="nav-link" href="<?php echo site_url('penelitian/seminar_hasil/');?>">
      <i class="fa fa-file-o"></i>
      <span class="nav-link-text">Berkas Seminar Hasil</span>
     </a>
  </li>
  <li class="nav-item" >
     <a class="nav-link" href="<?php echo site_url('reviewer/reviewer_profil_show/');?>">
      <i class="fa fa-user"></i>
      <span class="nav-link-text">Profil Reviewer</span>
     </a>
  </li>
<?php };?>
<!--  END Reviewer -->


</ul>

<ul class="navbar-nav sidenav-toggler">
  <li class="nav-item">
    <a class="nav-link text-center" id="sidenavToggler">
      <i class="fa fa-fw fa-angle-left"></i>
    </a>
  </li>
</ul>
<!--  RUNNING TEXT INFO -->
    <?php if(isset($runtext)){ ;?>
        <div class="navbar-nav  ml-auto container_running_text" >
            <marquee direction="left" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
                <?php
                $c=count($runtext);
                foreach ($runtext as $runview) {
                    $c--;
                    $ic=($runview->icon_run!="" || $runview->icon_run!=NULL) ? $runview->icon_run:"";
                    $wr=($runview->color_teks!="" || $runview->color_teks!=NULL) ? $runview->color_teks:"#ffed00";
                    echo '<span style="color:'.$wr.'!important;" ><i class="'.$ic.'"></i> '.$runview->text_to_run.'</span>';
                    if($c>0){
                        echo '<span style="margin:0px 30px 0px 30px;"><i class="fa fa-sun-o"></i></span>';
                    }

                };?>
            </marquee>
        </div>
    <?php };?>
<!--  END RUNNING TEXT INFO -->

        <ul class="navbar-nav ml-auto">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-user-circle"></i>
              <span class="d-lg-none">Profil</span>
              <?php echo $this->session->userdata('nama');?>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <?php
                $link_update="";
                if($this->session->userdata('akses')=="PENELITI"){
                    echo '<a class="dropdown-item" href="'.site_url('peneliti/peneliti_profil/'.$this->session->userdata('id_user')).'"><i class="fa fa-edit"></i> Ubah Data Profil</a>';
                    echo '<a class="dropdown-item" href="'.site_url('peneliti/foto/'.$this->session->userdata('id_user')).'"><i class="fa fa-picture-o"></i> Ubah Foto Profil</a>';
                }else
                if($this->session->userdata('akses')=="REVIEWER"){
                    echo '<a class="dropdown-item" href="'.site_url('reviewer/reviewer_profil/'.$this->session->userdata('id_user')).'"><i class="fa fa-edit"></i> Ubah Data Profil</a>';
                    echo '<a class="dropdown-item" href="'.site_url('reviewer/foto/'.$this->session->userdata('id_user')).'"><i class="fa fa-picture-o"></i> Ubah Foto Profil</a>';
                }else
                if($this->session->userdata('akses')=="SUA" || $this->session->userdata('akses')=="ADM"){
                    // action
                };?>


              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo site_url('util/gantipass');?>">
                <i class="fa fa-lock"></i> Ubah Password
              </a>
            </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('member_login/logout');?>">
                <i class="fa fa-fw fa-sign-out"></i> Logout
              </a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" >
              <i class="fa fa-fw fa-envelope"></i>
              <span class="d-lg-none">Pesan
                <span class="badge badge-pill badge-primary">12 New</span>
              </span>
              <span class="indicator text-primary d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
              </span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-bell"></i>
              <span class="d-lg-none">Alerts
                <span class="badge badge-pill badge-warning">6 New</span>
              </span>
              <span class="indicator text-warning d-none d-lg-block">
                <i class="fa fa-fw fa-circle"></i>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">New Alerts:</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <span class="text-success">
                 <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                </span>
                <span class="small float-right text-muted">11:21 AM</span>
                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="#">View all alerts</a>
            </div>
          </li> -->

        </ul>

  </div>
</nav>
