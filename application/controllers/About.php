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
    $this->TPL['basic'] = $this->getSubscriptions(1);
    $this->TPL['professional'] = $this->getSubscriptions(2);
    $this->TPL['enterprise'] = $this->getSubscriptions(3);

    $this->template->show('about', $this->TPL);
  }
  public function getCompanyInfo(){
     $query = $this->db-> query("SELECT info FROM settings WHERE setting_key=1;");
      $result = $query->result_array();
      $infArray = $result[0];
      return $infArray['info'];
      
  }
  public function getSubscriptions($id){
     $query = $this->db-> query("SELECT * FROM subscriptions WHERE subscription_id=$id;");
      $result = $query->result_array();
      return $result[0];
  }
}