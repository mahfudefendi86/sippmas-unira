<?php
class Template {
protected $_ci;
protected $theme;
 function __construct()
  {
    $this->_ci =&get_instance();
    $this->_ci->config->load('apps_settings');
    $this->theme=$this->_ci->config->item('theme');
  }

  function mainview($template,$content=null)
  {
    $this->_ci->load->model(array('runningtext/runningtext_model'));
    $theme=$this->theme;
    /*** Aktif kan text Running ***/
    $ops_rt="WHERE A.status_run='Y' and A.start_date <='".date('Y-m-d')."' and A.end_date >= '".date('Y-m-d')."' ";
    $content['runtext']=$this->_ci->runningtext_model->show_data_runningtext($ops_rt)->result();

    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['header']=$this->_ci->load->view('../../theme/'.$theme.'/header.php',$content,true);
    $data['footer']=$this->_ci->load->view('../../theme/'.$theme.'/footer.php',$content,true);
    $this->_ci->load->view('../../theme/'.$theme.'/mainpage.php',$data);
  }

  function a4_layout($template,$content=null)
  {
    $theme=$this->theme;
    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['header']=$this->_ci->load->view('../../theme/'.$theme.'/header.php',$content,true);
    $data['footer']=$this->_ci->load->view('../../theme/'.$theme.'/footer.php',$content,true);
    $this->_ci->load->view('../../theme/'.$theme.'/a4page.php',$data);
  }
  function a4_print($template,$content=null)
  {
    $theme=$this->theme;
    $data['content']=$this->_ci->load->view($template,$content, true);
    $this->_ci->load->view('../../theme/'.$theme.'/a4print.php',$data);
  }

  function index($template,$content=null)
  {
    $theme=$this->theme;
    $option=" WHERE A.status='PUBLISH' ORDER BY A.tanggal,A.jam DESC ";
    $this->_ci->load->model(array('kategori/kategori_model','berita/berita_model'));
    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['header']=$this->_ci->load->view('../../theme/'.$theme.'/public/jumbotron.php',$content,true);
    $data['menu']=$this->_ci->kategori_model->show_data_kategori()->result();
    $data['post']=$this->_ci->berita_model->show_data_berita($option,1,5)->result();
    $this->_ci->load->view('../../theme/'.$theme.'/public/index.php',$data);
  }

  function display($template,$content=null)
  {
    $theme=$this->theme;
    $option=" WHERE A.status='PUBLISH' ORDER BY A.tanggal,A.jam DESC ";
    $this->_ci->load->model(array('kategori/kategori_model','berita/berita_model'));
    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['header']=$this->_ci->load->view('../../theme/'.$theme.'/public/top_menu.php',$content,true);
    $data['menu']=$this->_ci->kategori_model->show_data_kategori()->result();
    $data['post']=$this->_ci->berita_model->show_data_berita($option,1,5)->result();
    $this->_ci->load->view('../../theme/'.$theme.'/public/index.php',$data);
  }

  function login($template,$content=null)
  {
    $theme=$this->theme;
    $data['content']=$this->_ci->load->view($template,$content, true);
    $this->_ci->load->view('../../theme/'.$theme.'/public/clear.php',$data);
  }

  function clear($template,$content=null)
  {
    $theme=$this->theme;
    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['footer']=$this->_ci->load->view('../../theme/'.$theme.'/footer.php',$content,true);
    $this->_ci->load->view('../../theme/'.$theme.'/clear.php',$data);
  }


  function kknview($template,$content=null)
  {
    $theme=$this->theme;
    $data['content']=$this->_ci->load->view($template,$content, true);
    $data['header']=$this->_ci->load->view('../../theme/'.$theme.'/header_kkn.php',$content,true);
    $data['footer']=$this->_ci->load->view('../../theme/'.$theme.'/footer.php',$content,true);
    $this->_ci->load->view('../../theme/'.$theme.'/mainpage.php',$data);
  }

}
