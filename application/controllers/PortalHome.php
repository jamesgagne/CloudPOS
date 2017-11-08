<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PortalHome extends CI_Controller {

  var $TPL;
  var $org;

  public function __construct()
  {
    parent::__construct(); 
    $this->load->model('HomeModel');
    $this->load->model('ProductsModel');
    $this->org = $this->HomeModel->getOrganization();
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->org;
    $this->TPL['contacts'] = $this->HomeModel->getContacts();
    $this->TPL['products'] = $this->ProductsModel->getData($this->TPL['org_details']['organization_ID']);
    $this->template->showCustomApp('portalHome', $this->TPL);
    }
    else{
    $this->template->show('home',$this->TPL);
    }

  }

  public function logout(){
    $this->userauth->logout();
  }


}