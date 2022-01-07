<?php if (!defined('BASEPATH')) {
    exit('No direct script acces allowed');
}

class Access
{
    public $user;
    protected $CI;
    /** COnstruktor */

    public function __construct()
    {
        $this->CI = &get_instance();
        //$auth = $this->CI->config->item('auth');

        $this->CI->load->helper('cookie');
        $this->CI->load->model('cekin_model');

        $this->cekin_model = &$this->CI->cekin_model;
    }

    /*cek Login User*/
    public function login($username, $password)
    {
        $result = $this->cekin_model->get_login_info($username);
        if ($result) {
            //cek akses bagian
            //if($result->identifikasi=="ADM" || $result->identifikasi=="SUA" || $result->identifikasi=="PENELITI"  || $result->identifikasi=="REVIEWER" ){
            $password = do_hash('de23239mex' . $password . 'by4489#&4', 'md5');
            if ($password === $result->password) {
                if ($result->status == "AKTIF") {
                    $this->CI->session->set_userdata('id_user', $result->userid);
                    $this->CI->session->set_userdata('akses', $result->identifikasi);
                    $this->CI->session->set_userdata('akses_kkn', $result->identifikasi_kkn);
                    $this->CI->session->set_userdata('nama', $result->nama);
                    $this->CI->session->set_userdata('status', $result->status);
                    return true;
                }
                return false;
            }
            return false;
            //}
            //return FALSE;
        }
        return false;
    }

    /* cek Apakah sudah login atau belum*/
    public function is_login()
    {
        return (($this->CI->session->userdata('id_user')) ? true : false);
    }

    /** Logout */
    public function logout()
    {
        $this->CI->session->unset_userdata('id_user');
        $this->CI->session->unset_userdata('akses');
        $this->CI->session->unset_userdata('akses_kkn');
        $this->CI->session->unset_userdata('nama');
        $this->CI->session->unset_userdata('status');
        $this->CI->session->sess_destroy();
    }

    /** Reset Password **/
    public function reset_password($email)
    {
        $result = $this->cekin_model->get_user($email);
        if ($result->num_rows() > 0) {
            $user = $result->row();
            $random = generate_psw();
            $password = do_hash('de23239mex' . $random . 'by4489#&4', 'md5');
            if ($user->status == "AKTIF") {
                $dataupd = array("password" => $password, "updated" => date('Y-m-d H:i:s'));
                $upd = $this->cekin_model->update_userlogin($dataupd, $user->id_login);
                if ($upd) {
                    return $random;
                } else {
                    return 'error';
                }
            }
            return '500';
        }
        return '404';
    }

}
