<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductForm extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function index()
  {
    $this->load->view('productForm',$this->TPL);

  }
    
}