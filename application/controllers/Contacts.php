<?php
/*first_name*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
     
  
  var $TPL;
  var $postErrors = array();
  var $org;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ContactsModel');
    $this->org = $this->getOrganization();
    // Your own constructor code
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->org;
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
    $validation = $this->ContactsModel->getValidationRules();

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run() == FALSE)
    { 
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
      $this->TPL['org_details'] = $this->org;
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
      if ($_POST['isEditing']=="true"){

      
        $this->ContactsModel->updateRecord($_POST);
      }
      else{
        $_POST['organization_ID'] = $this->org['organization_ID'];
        $this->ContactsModel->createRecord($_POST);
      
      }
      $this->index();
    }
  }


public function getContact($id){ 
  $org_id = $this->org['organization_ID'];  
   $contResult = $this->ContactsModel->getContact($id, $org_id);
   $addressResults = $this->ContactsModel->getAddress($id);
   $resp =  array_merge($contResult[0], $addressResults);

    echo json_encode($resp);


}
public function deleteContact($id){
    $resp = $this->ContactsModel->deleteRecord($id);
    if ($resp=="success"){
      echo json_encode(array('success' => true));
    }
    else{
    echo json_encode(array('success' => flase, 'error'=>$resp));
    }
}
  public function getFiltered($string){
  $org_id = $this->org['organization_ID'];
  $query = $this->db-> query("SELECT * FROM contacts where organization_ID=$org_id and (first_name like '%".$string."%' or contact_ID like '%".$string."%' or last_name like '%".$string."%' or email like '%".$string."%' or phone like '%".$string."%' or website like '%".$string."%' or company like '%".$string."%') ORDER BY contact_ID ASC;");
    echo json_encode($query->result_array());
    
  }

  public function getAll(){
    $org_id = $this->org['organization_ID'];
    $result = $this->ContactsModel->getData($org_id);
  echo json_encode($result);
  }
  

}