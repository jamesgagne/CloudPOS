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
      $this->TPL['cityOptions'] = $this->getAllCities();
      $this->TPL['countryOptions'] = $this->getAllCountries();
     $this->template->show('register', $this->TPL);
   
  }
  
  public function reset(){
     $this->template->show('register', $this->TPL);
  }
  
  public function newentry(){
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

$validation = array(
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email',
    'errors' => array(
                        'required' => 'You must provide an %s.'
                )
        ),
        array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required|min_length[5]|max_length[15]|alpha',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        array(
                'field' => 'organization_name',
                'label' => 'Organization Name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide an %s.'
                )
        ),
        array(
                'field' => 'website',
                'label' => 'Business Url',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        array(
                'field' => 'address',
                'label' => 'Business Street Address',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        array(
                'field' => 'city',
                'label' => 'City of Organization',
                'rules' => array('required', 
                  array('city',
                        function($value){
                 if($value!=0){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'city' => 'Please select a valid city'
                )
        ),
        array(
                'field' => 'country',
                'label' => 'Country of Organization',
                'rules' => array('required', 
                  array('country',
                        function($value){
                 if($value!=0){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'country' => 'Please select a valid country'
                )
        ),
        array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required|min_length[5]|max_length[20]|alpha',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
         array(
                'field' => 'subscriptionType',
                'label' => 'Subscription Type',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
        array(
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => array('required', 
                  array('phone',
                        function($value){
                    $phonePattern = "/^[0-9]{3}-[0-9]{4}$/";
                    if(preg_match($phonePattern, $value)){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'phone' => '{field} must be in format of ###-####'
        )
  ),
        array(
                'field' => 'company_color',
                'label' => 'Primary Company Color',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
        array(
                'field' => 'company_img',
                'label' => 'Company Logo',
                'rules' => array(array('img', function($value){
                  if (isset($_FILES['company_img'])){
                    return true;

                  }
                  else{
                    return false;
                  }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),  
        array(
                'field' => 'cont_address',
                'label' => 'Street Address',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
        array(
                'field' => 'cont_city',
                'label' => 'City',
                'rules' => array('required', 
                  array('city',
                        function($value){
                 if($value!=0){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'city' => 'Please select a valid city'
                )
        ),
        array(
                'field' => 'cont_country',
                'label' => 'Country',
                'rules' => array('required', 
                  array('country',
                        function($value){
                 if($value!=0){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'country' => 'Please select a valid country'
                )
        ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
        array(
                'field' => 'pass_conf',
                'label' => 'Password Confirmation',
                'rules' => array('required', 
                  array('match',
                        function($value){
                 if($value==$this->input->post("password")){
    
                      return TRUE;
                    }
                    else{
                      return FALSE;
                    }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'match' => 'This does not match the Password above'

    )
        ),
);

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == FALSE)
                { 

                      $this->TPL['cityOptions'] = $this->getAllCities();
                      $this->TPL['countryOptions'] = $this->getAllCountries();
                       $this->template->show('register', $this->TPL);
                }
                else
                {
                
                 

         $organization_name = $this->input->post("organization_name");
         $website = $this->input->post("website");
         $address = $this->input->post("address");
         $city = $this->input->post("city");
         $fname = $this->input->post("firstName");
         $lname = $this->input->post("lastName");
         $phone = $this->input->post("phone");
         $email = $this->input->post("email");
         $country = $this->input->post("country");
         $subscription_id = $this->input->post("subscriptionType");
         $city = $this->input->post("city");
         $company_img = $_FILES["company_img"]['name'];
         $company_color = $this->input->post("company_color");
         $cont_address = $this->input->post("cont_address");
         $cont_city = $this->input->post("cont_city");
         $cont_country = $this->input->post("cont_country");
         $password = sha1($this->input->post("password"));
         $salt = sha1($organization_name);
         $storedVal = sha1($password.$salt);
         date_default_timezone_set('America/Toronto');
         $billing_due_date = date("Y-m-d H:i:s");
        $q = $this->db->conn_id->prepare("insert into organizations(name,website,image,subscription_id,company_color,billing_due_date) VALUES ( ?,?,?,?,?,?)");
           $q->bind_param("ssssss",$organization_name, $website, $company_img,$subscription_id,$company_color,$billing_due_date); 
            if ($q->execute()){
              $this->TPL['resp'] = "<p class='text-success'>Thanks for reaching out we will get back to you as soon as possible :)";
              if (isset($_FILES['company_img'])){
                  mkdir("/home/student/000328298/public_html/private/CloudPOS/application/assets/img/".$this->input->post("organization_name"));
                    $src = $_FILES['company_img']['tmp_name'];
                    $destination  ="/home/student/000328298/public_html/private/CloudPOS/application/assets/img/".$this->input->post("organization_name")."/" . $_FILES['company_img']['name'];
                    copy($src, $destination);                   
                  }
                  $new_org_id = $q->insert_id;
                   $userQuery = $this->db->conn_id->prepare("insert into users(first_name,last_name,organization_id,role_id,phone,hash,salt,email,is_primary) VALUES ( ?,?,?,?,?,?,?,?,?)");
                   $user_level = 1;
                   $is_primary = 1;
                   $userQuery->bind_param("sssssssss",$fname, $lname, $new_org_id, $user_level, $phone, $storedVal, $salt, $email, $is_primary);
         
                  if ($userQuery->execute()){
                    $new_user_id = $userQuery->insert_id;
                    $orgAddressQuery = $this->db->conn_id->prepare("insert into addresses(street_address,city_id,country_id,organization_id) VALUES ( ?,?,?,?)");
                    $orgAddressQuery->bind_param("ssss",$address, $city, $country, $new_org_id);
                    if ($orgAddressQuery->execute()){
                    
                    }
                    else{
                      $this->TPL['resp'] = $orgAddressQuery->error;
                    }
                    $contAddressQuery = $this->db->conn_id->prepare("insert into addresses(street_address,city_id,country_id,user_id) VALUES ( ?,?,?,?)");
                    $contAddressQuery->bind_param("ssss",$cont_address, $cont_city, $cont_country, $new_user_id);
                    if ($contAddressQuery->execute()){
                    
                    }
                    else{
                      $this->TPL['resp'] = $contAddressQuery->error;
                    }

                  
                  }
                  else{
                    $this->TPL['resp'] = $userQuery->error;
                  }
           }
           else{
            $this->TPL['resp'] = $q->error;
           }
          
                      $this->TPL['cityOptions'] = $this->getAllCities();
                      $this->TPL['countryOptions'] = $this->getAllCountries();
                      $this->template->show('register', $this->TPL);
                } 


  }
    
  
  public function getAllCities(){
    $cities = array();
    $cities[0] = "Please Select";
    $query = $this->db-> query("SELECT  city_id, name FROM cities;");
      $result = $query->result_array();
      foreach ($result as $key => $value) {
        $cities[$value['city_id']] = $value['name'];
      }
      return $cities;
  }
  public function getAllCountries(){
    $countries = array();
    $countries[0] = "Please Select";
    $query = $this->db-> query("SELECT country_id, name FROM countries;");
       $result = $query->result_array();
      foreach ($result as $key => $value) {
        $countries[$value['country_id']] = $value['name'];
      }
      return $countries;
  }

}

