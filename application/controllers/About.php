<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function index()
  {
    $this->TPL['info'] = $this->getCompanyInfo();
    $this->template->show('about', $this->TPL);
  }
  public function getCompanyInfo(){
     $query = $this->db-> query("SELECT info FROM settings WHERE setting_key=1;");
      $result = $query->result_array();
      $infArray = $result[0];
      return $infArray['info'];
      
  }
}