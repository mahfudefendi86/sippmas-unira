<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'format_tanggal'));
        $this->load->library('template');
        $this->load->model(array('main_model', 'berita/berita_model', 'kategori/kategori_model', 'peneliti/peneliti_model', 'reviewer/reviewer_model', 'slideshow/slideshow_model'));
    }

    public function index()
    {
        $data['title'] = "SIPPMas (Sistem Informasi Penelitian Dan Pengabdian Masyarakat)";
        $ops = " WHERE A.status='Publish' ";
        $data['slideshow'] = $this->slideshow_model->show_data_slideshow($ops)->result();
        $this->template->index('main/content_index', $data);

    }

    public function dashboard()
    {
        if ($this->session->userdata('id_user')) {
            $data['title'] = "Dashboard";
            $u = null;
            if ($this->session->userdata('akses') == "PENELITI") {
                $u = $this->peneliti_model->get_by_id_peneliti($this->session->userdata('id_user'))->row();
            } else if ($this->session->userdata('akses') == "REVIEWER") {
                $u = $this->reviewer_model->get_by_id_reviewer($this->session->userdata('id_user'))->row();
            }
            $sql_berita = "SELECT count(*) as jumlah FROM pub_berita ";
            $data['num_berita'] = $this->db->query($sql_berita)->row();

            $sql_penelitian = "SELECT count(*) as jumlah FROM pr_penelitian ";
            $data['num_usulan'] = $this->db->query($sql_penelitian)->row();

            $sql_aut = "SELECT count(*) as jumlah FROM tbl_peneliti ";
            $data['num_peneliti'] = $this->db->query($sql_aut)->row();

            $sql_aut = "SELECT count(*) as jumlah FROM pub_berita_kategori ";
            $data['num_kategori'] = $this->db->query($sql_aut)->row();

            $data['user'] = $u;
            $this->template->mainview('main/content', $data);
        } else {
            redirect("main/index/");
        }
    }

    public function berita($st = null, $option = "")
    {
        $in = $this->input->post(null, true);
        if (!$in) {redirect('main');};
        $row = 5;
        $sort = "";
        $filt = "";
        $option .= " WHERE A.status='PUBLISH' ";
        if ($st == null) {$start = 0;} else { $start = $st;};
        if ($in['cari'] != null || $in['cari'] != "") {
            ($option == "") ? $option .= " WHERE " : $option .= " AND ";
            $option .= " (  A.judul LIKE '%" . $in['cari'] . "%' ) ";
        }
        $option .= $filt;
        $option .= " ORDER BY A.tanggal,A.jam DESC ";
        ///pengaturan pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('main/berita');
        $config['first_url'] = site_url('main/berita/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->berita_model->show_data_berita($option)->num_rows();
        //inisialisasi config
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['berita'] = $this->berita_model->show_data_berita($option, $start, $config['per_page'])->result();
        $this->load->view('main/content_berita', $data);
    }

    public function link($id = "")
    {
        $data[] = null;
        if ($id != "") {
            /*ambil data link*/
            $sql = "SELECT * FROM pub_berita_kategori WHERE id_kategori='" . $id . "' ";
            $d = $this->db->query($sql);
            if ($d->num_rows() > 0) {
                $data_link = $d->row();
                $data['title'] = $data_link->kategori;
            }
        } else {
            $data['title'] = "Berita";
        }
        $data['link'] = $id;
        $this->template->display('main/content_link', $data);
    }

    public function link_show($st = null, $option = "")
    {
        $in = $this->input->post(null, true);
        if (!$in) {redirect('main');};
        $row = 5;
        $sort = "";
        $filt = "";
        $option .= " WHERE A.status='PUBLISH' ";
        if ($st == null) {$start = 0;} else { $start = $st;};
        if ($in['link'] != null || $in['link'] != "") {
            ($option == "") ? $option .= " WHERE " : $option .= " AND ";
            $option .= " A.id_kategori='" . $in['link'] . "' ";
        }
        if ($in['cari'] != null || $in['cari'] != "") {
            ($option == "") ? $option .= " WHERE " : $option .= " AND ";
            $option .= " (  A.judul LIKE '%" . $in['cari'] . "%' ) ";
        }
        $option .= $filt;
        $option .= " ORDER BY A.tanggal,A.jam DESC ";
        ///pengaturan pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('main/link_show');
        $config['first_url'] = site_url('main/link_show/0');
        $config['uri_segment'] = 3; ///Untuk menentukan jumlah record yang tampil
        $config['per_page'] = $row;
        $config['total_rows'] = $this->berita_model->show_data_berita($option)->num_rows();
        //inisialisasi config
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['start'] = $start;
        $data['end'] = $start + $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['berita'] = $this->berita_model->show_data_berita($option, $start, $config['per_page'])->result();
        $this->load->view('main/content_berita', $data);
    }
    /**
     *  Detail berita
     *
     */

    public function detail($id = "", $judul = "")
    {
        $data[] = null;
        if ($id != "") {
            $b = $this->berita_model->get_by_id_berita($id);
            if ($b->num_rows() > 0) {
                $data['berita'] = $b->row();
                $data['title'] = $data['berita']->judul;
                $this->template->display('main/detail_berita', $data);
            } else {
                redirect('main/info/invalid');
            }
        } else {
            redirect('main/info/invalid');
        }
    }

    public function info($o = "")
    {
        $data[] = null;
        $data['title'] = "Informasi";
        if ($o != "") {
            if ($o == "valid") {
                $data['notif'] = '<div class="alert alert-success " ><h2><i class="fa fa-info-circle"></i> Berita berhasil disimpan...</h2>
				<br/><a class="btn btn-success btn-sm" href="' . site_url('main') . '" title="Kembali ke Daftar Penelitian"><i class="fa fa-chevron-left"></i> Kembali ke Daftar Berita</a>
				</div>';
            } else
            if ($o == "invalid") {
                $data['notif'] = '<div class="alert alert-danger" ><h2><i class="fa fa-exclamation-triangle"></i> <strong>MAAF!</strong> Berita tidak ditemukan...</h2>
				<br/><a class="btn btn-success  btn-sm" href="' . site_url('main') . '" title="Kembali ke Beranda"><i class="fa fa-chevron-left"></i> Kembali ke Beranda</a>
				</div>';
            }
            $this->template->display('main/info', $data);
        }
    }

/*******************************************************
 *            PENDAFTARAN PESERTA KKN
 ******************************************************/
    public function registrasi_kkn()
    {
        $data['title'] = "Registrasi Peserta Kuliah Kerja Nyata (KKN)";
        $data['id_fakultas'] = $this->main_model->select_fakultas()->result();
        $data['provinsi'] = $this->main_model->selectProvinsi()->result();
        $data['image'] = $this->_create_captcha();
        //print("<pre>" . print_r($data, true) . "</pre>");
        $this->template->display('main/kkn_reg', $data);
    }

    public function save_kkn()
    {
        $in = $this->input->post(null, true);

        $upload_image = $_FILES['kknn_upload']['name'];

        $data_in = [
            "id_peserta" => random_id(),
            "nama_mhs" => $in["kknn_nama_lengkap"],
            "email" => $in["kknn_email"],
            "hp" => $in["kknn_nomer_hp"],
            "nim" => $in["kknn_nim"],
            "jenis_kelamin" => $in["kknn_jenis_kelamin"],
            "tempat_lahir" => $in["kknn_tempat_lahir"],
            "tgl_lahir" => $in["kknn_tanggal_lahir"],
            "usia" => $in["kknn_usia"],
            "alamat_domisili" => $in["kknn_alamat_domisili"],
            "provinsi" => $in["kknn_provinsi"],
            "kota" => $in["kknn_kota"],
            "kecamatan" => $in["kknn_kecamatan"],
            "kelurahan" => $in["kknn_kelurahan"],
            "id_fakultas" => $in["kknn_fakultas"],
            "id_prodi" => $in["kknn_program_pendidikan"],
            "kesehatan" => $in["kknn_kondisi_kesehatan"],
            "penyakit_diderita" => $in["kknn_penyakit"],
            "keluarga" => json_encode($in["kknn_memiliki_keluarga"]),
            "is_hamil" => (isset($in["kknn_hamil"]) ? $in["kknn_hamil"] : ''),
            "is_kerja" => $in["kknn_bekerja"],
            "pekerjaan" => (isset($in["kknn_pekerjaan"]) ? $in["kknn_pekerjaan"] : ''),
            "status_pekerjaan" => (isset($in["kknn_status_pekerjaan"]) ? $in["kknn_status_pekerjaan"] : ''),
            "alamat_kerja" => (isset($in["kknn_alamat_kerja"]) ? $in["kknn_alamat_kerja"] : ''),
            "ukuran_jaket" => $in["kknn_ukuran_jaket"],
            //"berkas" => $upload_image, //$in["kknn_upload"],
        ];

        $captcha = $in['security_code'];

        if ($upload_image) {
            $config = [
                'allowed_types' => 'jpg|jpeg|pdf',
                'max_size' => '1024',
                'file_name' => str_replace(' ', '_', 'kkn_' . $data_in['nim']),
                'upload_path' => './asset/uploads/berkas/pembayaran_kkn/',
            ];

            $this->load->library('upload');

            $this->upload->initialize($config);

            if ($this->upload->do_upload('kknn_upload')) {
                $new_image = [
                    'berkas' => $this->upload->data('file_name'),
                ];
                $data_in = array_merge($data_in, $new_image);
            } else {
                echo $this->upload->dispay_errors();
            }
        }

        $message = $this->load->view('email_content', $data_in, true);

        $data_email = [
            'receiver' => $data_in['email'],
            'cc' => '',
            'bcc' => '',
            'subject' => 'Pendaftaran KKN',
            'message' => $message,
        ];

        if ($captcha == $this->session->userdata('kode_capthca')) {
            $sendmail = $this->send_email($data_email);

            if ($sendmail['status'] == "success") {
                $input_data = $this->db->insert('kkn_peserta_registrasi', $data_in);

                if ($input_data) {
                    $notif = "Pendaftaran KKN Berhasil.";
                    // $notif = '<div class="alert alert-success alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-info-circle"></i> Pendaftaran KKN Berhasil...
                    // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    echo json_encode(array('msg' => $notif, 'status' => 'OK'));

                    $this->session->unset_userdata('kode_capthca');
                } else {
                    $notif = "Pendaftaran KKN Gagal.";
                    // $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Pendaftaran KKN Gagal...
                    // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
                }
            } else {
                // $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Pendaftaran KKN Gagal, Email gagal dikirimkan. Pastikan email anda valid.
                // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $notif = "Pendaftaran KKN Gagal, Email gagal dikirimkan. Pastikan email anda valid.";
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        } else {
            // $notif = '<div class="alert alert-danger alert-dismissable" onclick="$(this).fadeOut(300);"><i class="fa fa-exclamation-triangle"></i> <strong>Maaf!</strong> Kode Capthca anda tidak sama.
            // <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $notif = "Maaf Kode Capthca anda tidak sama.";
            echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
        }
    }

    public function konfirmasi_kkn($id_peserta = null)
    {
        $in = $this->input->post(null, true);

        $data['mhs'] = $this->db->get_where('kkn_peserta_registrasi', ['id_peserta' => $id_peserta])->row_array();

        if (!$in) {
            $data['title'] = "Konfirmasi Pendaftaran Peserta Kuliah Kerja Nyata (KKN)";
            $data['image'] = $this->_create_captcha();
            $data['id_peserta'] = $id_peserta;

            $this->template->login('main/kkn_conf', $data);
        } else {
            $mhs = $data['mhs'];

            $data_in = [
                "id_login" => random_id(),
                "userid" => $id_peserta,
                "username" => $in['username'],
                "password" => password_hash($in['password'], PASSWORD_DEFAULT),
                "nama" => $mhs['nama_mhs'],
                "alamat" => $mhs['alamat_domisili'],
                "email_recv" => $mhs['email'],
                "hp_recv" => $mhs['hp'],
                "created" => date('Y-m-d H:i:s'),
                // "updated" => date('Y-m-d H:i:s'),
                "identifikasi" => "MAHASISWA",
                "status" => "NONAKTIF",
            ];

            $captcha = $in['security_code'];

            if ($in['password'] == $in['conf_password']) {
                if ($captcha == $this->session->userdata('kode_capthca')) {
                    $input_data = $this->db->insert('_m_usr_login', $data_in);

                    if ($input_data) {
                        $notif = "Konfirmasi Pendaftaran KKN Berhasil.";
                        echo json_encode(array('msg' => $notif, 'status' => 'OK'));
                    } else {
                        $notif = "Konfirmasi Pendaftaran KKN Gagal.";
                        echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
                    }
                    $this->session->unset_userdata('kode_capthca');
                } else {
                    $notif = "Maaf Kode Capthca anda tidak sama.";
                    echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
                }
            } else {
                $notif = "Password konfirmasi harus sama dengan password.";
                echo json_encode(array('msg' => $notif, 'status' => 'ERROR'));
            }
        }
    }

    private function _create_captcha()
    {
        // we will first load the helper. We will not be using autoload because we only need it here
        $this->load->helper('captcha');
        // we will set all the variables needed to create the captcha image
        $options = array(
            'img_path' => './captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => 150,
            'img_height' => 40,
            'border' => 0,
            'expiration' => 7200,
        );
        //now we will create the captcha by using the helper function create_captcha()
        $cap = create_captcha($options);
        // we will store the image html code in a variable
        $image = $cap['image'];

        // ...and store the captcha word in a session
        $this->session->set_userdata('kode_capthca', $cap['word']);
        // we will return the image html
        return $image;
    }

    private function send_email($data)
    {
        $this->load->library('email');

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_user' => 'uniraclassroom@gmail.com',
            'smtp_pass' => 'ucr260495',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'validate' => true,
            'priority' => 1,
            'newline' => "\r\n",
            'bcc_batch_mode' => true,
            'bcc_batch_size' => 200,
        ];

        $this->email->initialize($config);

        $this->email->from('uniraclassroom@gmail.com', 'Unira Classroom');
        $this->email->to($data['receiver']);

        if ($data['cc'] != "") {
            $this->email->cc($data['cc']);
        }
        if ($data['bcc'] != "") {
            $this->email->bcc($data['bcc']);
        }

        $this->email->subject($data['subject']);
        $this->email->message($data['message']);

        if ($this->email->send()) {
            // return true;
            $alert = [
                'status' => 'success',
                'msg' => 'Email terkirim',
            ];
        } else {
            // echo $this->email->print_debugger();
            // die;
            $alert = [
                'status' => 'error',
                'msg' => 'Email tidak terkirim',
            ];
        }
        return $alert;
    }

    public function get_fakultas()
    {
        $data = $this->main_model->select_fakultas()->result();
        echo json_encode($data);
    }

    public function get_prodi()
    {
        $id_fakultas = $this->input->post('id_fakultas', true);
        $data = $this->main_model->select_prodi($id_fakultas)->result();
        echo json_encode($data);
    }

    public function get_provinsi()
    {
        $data = $this->main_model->selectProvinsi()->result();
        echo json_encode($data);
    }

    public function get_kota()
    {
        $id_prov = $this->input->post('id_prov', true);
        $data = $this->main_model->selectKota($id_prov)->result();
        echo json_encode($data);
    }

    public function get_kecamatan()
    {
        $id_kota = $this->input->post('id_kota', true);
        $data = $this->main_model->selectKecamatan($id_kota)->result();
        echo json_encode($data);
    }

    public function get_kelurahan()
    {
        $id_kec = $this->input->post('id_kec', true);
        $data = $this->main_model->selectKelurahan($id_kec)->result();
        echo json_encode($data);
    }

}
