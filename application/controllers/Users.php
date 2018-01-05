<?php
/*first_name*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
     
  
  var $TPL;
  var $postErrors = array();
  var $org;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('HomeModel');
    $this->load->model('UsersModel');
    $this->org = $this->getOrganization();
    // Your own constructor code
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){
       $user = $this->HomeModel->getUser($_SESSION['user_id']);
      if ($user['role_ID']!=1){
        redirect('PortalHome/notAdmin');
      }
      else{ 
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->org;
      $this->TPL['headerid'] = "User ID";
      $this->TPL['headerfname']= "First Name";
      $this->TPL['headerlname']= "Last Name";
      $this->TPL['headerphone']= "Phone";
      $this->TPL['headeremail']= "Email";
      $this->TPL['headerwebsite']= "Pay Rate";
    $this->TPL['showForm'] = false;
    $this->template->showCustomApp('users', $this->TPL);
      }

    }
    else{
    redirect('Home');
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
    if($_POST['isEditing']){
      $validation = $this->UsersModel->getEditValidationRules();
    }
    else{
      $validation = $this->UsersModel->getValidationRules();
    }
    

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run() == FALSE)
    { 
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
      $this->TPL['org_details'] = $this->org;
      $this->TPL['listing'] = $this->UsersModel->getData($this->TPL['org_details']['organization_ID']);
      $this->TPL['headerid'] = "User ID";
      $this->TPL['headerfname']= "First Name";
      $this->TPL['headerlname']= "Last Name";
      $this->TPL['headerphone']= "Phone";
      $this->TPL['headeremail']= "Email";
      $this->TPL['headerwebsite']= "Pay Rate";

      $this->TPL['showForm'] = true;

      $this->template->showCustomApp('users', $this->TPL);
    }
    else
    {
      if ($_POST['isEditing']=="true"){

      
        $this->UsersModel->updateRecord($_POST);
      }
      else{
        $_POST['organization_ID'] = $this->org['organization_ID'];
          $password = sha1($this->input->post("password"));
         $salt = sha1($this->input->post("first_name"));
         $_POST['storedVal'] = sha1($password.$salt);
         $_POST['salt'] = $salt;
        $this->UsersModel->createRecord($_POST);
      
      }
      $this->index();
    }
  }


public function getContact($id){ 
  $org_id = $this->org['organization_ID'];  
   $contResult = $this->UsersModel->getContact($id, $org_id);
  

    echo json_encode($contResult);


}
public function deleteContact($id){
    $resp = $this->UsersModel->deleteRecord($id);
    if ($resp=="success"){
      echo json_encode(array('success' => true));
    }
    else{
    echo json_encode(array('success' => flase, 'error'=>$resp));
    }
}
  public function getFiltered($string){
  $org_id = $this->org['organization_ID'];
  $query = $this->db-> query("SELECT * FROM users where organization_ID=$org_id and (first_name like '%".$string."%' or user_ID like '%".$string."%' or last_name like '%".$string."%' or email like '%".$string."%' or phone like '%".$string."%' or sin like '%".$string."%' or pay_rate like '%".$string."%') ORDER BY contact_ID ASC;");
    echo json_encode($query->result_array());
    
  }

  public function getAll(){
    $org_id = $this->org['organization_ID'];
    $result = $this->UsersModel->getData($org_id);
  echo json_encode($result);
  }
  

}