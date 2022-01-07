<?php

class Main_kkn extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$data['title'] = "Dashboard KKN";
        //$this->load->view('main_kkn/main_kkn_index', $data);
        redirect('peserta/kkn');
    }
}
