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
    $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->template->show('home', $this->TPL);
  }
    public function loginuser()
  {
    $this->TPL['msg'] =
      $this->userauth->login($this->input->post("email"),
                             $this->input->post("password"));

    $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->template->show('home', $this->TPL);
  }
  public function logout(){
    $this->userauth->logout();
  }
}