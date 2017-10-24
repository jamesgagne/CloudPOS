<?php
/*first_name*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

  var $TPL;
  var $postErrors = array();

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){     
    $this->load->model('ContactsModel');
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->getOrganization();
    $this->TPL['listing'] = $this->ContactsModel->getData($this->TPL['org_details']['organization_ID']);
    $this->TPL['headerid'] = "Contact ID";
    $this->TPL['headerfname']= "First Name";
    $this->TPL['headerlname']= "Last Name";
    $this->TPL['headerphone']= "Phone";
    $this->TPL['headeremail']= "Email";
    $this->TPL['headerwebsite']= "Website";
    $this->TPL['headercompany']= "Comapny";
    $this->TPL['headertype']= "Type";
    $this->TPL['showForm'] = false;
      $this->TPL['cityOptions'] = $this->ContactsModel->getAllCities();
      $this->TPL['countryOptions'] = $this->ContactsModel->getAllCountries();
    $this->template->showCustomApp('contacts', $this->TPL);

    }
    else{
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

  public function formSubmit(){
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');   
    $this->load->model('ContactsModel');
    $validation = $this->ContactsModel->getValidationRules();

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run() == FALSE)
    { 
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
      $this->TPL['org_details'] = $this->getOrganization();
      $this->TPL['listing'] = $this->ContactsModel->getData($this->TPL['org_details']['organization_ID']);
      $this->TPL['headerid'] = "Contact ID";
      $this->TPL['headerfname']= "First Name";
      $this->TPL['headerlname']= "Last Name";
      $this->TPL['headerphone']= "Phone";
      $this->TPL['headeremail']= "Email";
      $this->TPL['headerwebsite']= "Website";
      $this->TPL['headercompany']= "Comapny";
      $this->TPL['headertype']= "Type";

      $this->TPL['cityOptions'] = $this->ContactsModel->getAllCities();
      $this->TPL['countryOptions'] = $this->ContactsModel->getAllCountries();
      $this->TPL['showForm'] = true;

      $this->template->showCustomApp('contacts', $this->TPL);
    }
    else
    {
      if ($_POST['isEditing']){

      //$this->ContactsModel->updateRecord($_POST);
      }
      else{
      //$this->ContactsModel->createRecord($_POST);
      
      }

      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
      $this->TPL['org_details'] = $this->getOrganization();
      $this->TPL['listing'] = $this->ContactsModel->getData($this->TPL['org_details']['organization_ID']);
      $this->TPL['headerid'] = "Contact ID";
      $this->TPL['headerfname']= "First Name";
      $this->TPL['headerlname']= "Last Name";
      $this->TPL['headerphone']= "Phone";
      $this->TPL['headeremail']= "Email";
      $this->TPL['headerwebsite']= "Website";
      $this->TPL['headercompany']= "Comapny";
      $this->TPL['headertype']= "Type";

      $this->TPL['cityOptions'] = $this->ContactsModel->getAllCities();
      $this->TPL['countryOptions'] = $this->ContactsModel->getAllCountries();        
      $this->TPL['showForm'] = false;
      $this->template->showCustomApp('contacts', $this->TPL);
    }
  }


public function getContact($id){ 
  $org = $this->getOrganization();
  $org_id = $org['organization_ID'];  
    $this->load->model('ContactsModel');
   $contResult = $this->ContactsModel->getContact($id, $org_id);
   $addressResults = $this->ContactsModel->getAddress($id);
   $resp =  array_merge($contResult[0], $addressResults);

    echo json_encode($resp);


}

  

}