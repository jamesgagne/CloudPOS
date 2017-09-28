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

     $this->template->show('contact', $this->TPL);
   
  }
  
  public function reset(){
     $this->template->show('contact', $this->TPL);
  }
  public function submit($name, $email, $msg){
    $name = urldecode($name);
    $email = urldecode($email);
    $msg = urldecode($msg);
    date_default_timezone_set('America/Toronto');
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $msg = htmlspecialchars($msg);
    $q = $this->db->conn_id->prepare("insert into requests(name,email,message,status,datetime) VALUES ( ?,?,?,?,?)");
    $q->bind_param("sssss",$name, $email, $msg, $status,$datetime);
    $status ="pending";
    $datetime = date("Y-m-d H:i:s"); 
    if ($q->execute()){
      $resp = "<p class='text-success'>Thanks for reaching out we will get back to you as soon as possible :)";

    }
    else{
      $resp = "<p class='text-error'>Sorry Something went wrong, please try to reset and submit again";
    }
  echo json_encode($resp);

  }

}
