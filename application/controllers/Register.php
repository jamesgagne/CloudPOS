<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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

     $this->template->show('register', $this->TPL);
   
  }
  
  public function reset(){
     $this->template->show('register', $this->TPL);
  }
  public function submit($name, $email, $msg){
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $msg = htmlspecialchars($msg);
    $query = $this->db->query("insert into requests(name,email,message) VALUES ( '$name','$email','$msg')");
    if ($query){
      $resp = "<p class='text-success'>Thanks for reaching out we will get back to you as soon as possible :)";

    }
    else{
      $resp = "<p class='text-error'>Sorry Something went wrong, please try to reset and submit again";
    }
  echo json_encode($resp);

  }

}
