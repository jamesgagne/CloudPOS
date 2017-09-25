<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function index()
  {
    if (isset($_POST['request'])){

    }
    $this->TPL['info'] = $this->getCompanyInfo();

     $this->template->show('contact', $this->TPL);
   
  }
  public function getCompanyInfo(){
     $query = $this->db-> query("SELECT info FROM settings WHERE setting_key=1;");
      $result = $query->result_array();
      $infArray = $result[0];
      return $infArray['info'];
      
  }
  public function reset(){
     $this->template->show('contact', $this->TPL);
  }
  public function submit($name, $email, $msg){
    $query = $this->db->prepare("insert into requests(name,email,message,status) VALUES ( ?, ?, ?, ?)");
  $stmt->bind_param("sss",$name, $email, $msg, $date, $status);
    $status = "pending";
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $msg = htmlspecialchars($msg);
    $stmt->execute();
    if ($stmt){
      $resp = "success";
    }
    else{
      $resp = "fail";
    }
  echo json_encode($resp);

  }

}