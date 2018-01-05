<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->getOrganization();
    $this->template->showCustomApp('home', $this->TPL);
    }
    else{
    $this->template->show('home',$this->TPL);
    }

  }
    public function loginuser()
  {
    $this->TPL['msg'] =
      $this->userauth->login($this->input->post("email"),
                             $this->input->post("password"));
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();

    if($this->userauth->validSessionExists()){
    $this->TPL['org_details'] = getOrganization();
    $this->template->showCustomApp('home', $this->TPL);
    
    }
    else{
      $this->TPL['alertMsg'] = "Sorry The email and password do not match";
      $this->template->show('home',$this->TPL);
    }
  }
  public function logout(){
    $this->userauth->logout();
  }

  public function getOrganization(){
    session_start(); 
    $org_id = $_SESSION['org_id'];
    $query = $this->db-> query("SELECT * FROM organizations WHERE organization_id=$org_id;");
      $result = $query->result_array();
      return $result[0];
  }
}