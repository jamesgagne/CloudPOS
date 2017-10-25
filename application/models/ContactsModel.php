<?php
class ContactsModel extends CI_Model{
 /*
 --contacts--
 first_name 
 last_name
 organization_ID
 email
 website
 company
 phone
 --addresses--
 street_address
 city_ID
 country_ID 
 organization_id
 user_id
 type=cont||user
 */
public function deleteRecord($id){
	$this->db->delete('contacts', array('contact_ID' => $id)); 
	$this->db->delete('addresses', array('user_id' => $id, 'type'=>'cont')); 
	return "success"; 
}

public function createRecord($post){
$data = array(
               'first_name' => $post['first_name'],
               'last_name' => $post['last_name'],
               'email' => $post['email'],
               'phone' => $post['phone'],
               'website' => $post['website'],
               'type' => $post['type'],
               'organization_ID' => $post['organization_ID'],
               'company'=> $post['company']
            );
$q = $this->db->insert('contacts', $data); 
$new_cont_id = $this->db->insert_id();

	$data = array(
               'street_address' => $post['address'],
               'city_ID' => $post['city'],
               'country_ID' => $post['country'],
               'type'=> 'cont',
               'user_id' => $new_cont_id,
               'organization_id' => $post['organization_ID']
            );
$this->db->insert('addresses', $data); 
}
public function updateRecord($post){
	$data = array(
               'first_name' => $post['first_name'],
               'last_name' => $post['last_name'],
               'email' => $post['email'],
               'phone' => $post['phone'],
               'website' => $post['website'],
               'type' => $post['type'],
               'company'=> $post['company']
            );

$this->db->where('contact_ID', $post['contact_ID']);
$this->db->update('contacts', $data); 
	
	$data = array(
               'street_address' => $post['address'],
               'city_ID' => $post['city'],
               'country_ID' => $post['country']
            );

$this->db->where(array('user_id'=>$post['contact_ID'],'type'=>'cont'));
$this->db->update('addresses', $data);
 
}

 public function getAddress($id){
 	 	$query = $this->db->get_where('addresses',array('user_id' => $id, 'type'=>'cont'));
 	 	$add= $query->result_array();
 	$address=$add[0];
 	$query = $this->db->get_where('cities', array('city_ID' => $address['city_ID']));
 	$ci = $query->result_array();
 	$city =  $ci[0];
 	$query = $this->db->get_where('countries', array('country_ID' => $address['country_ID']));
 	$co =$query->result_array();
 	$country =  $co[0];
 	$resp = array('address' => $address['street_address'], 'city' => $city['city_ID'], 'country'=>$country['country_ID'] );
 	
 	return $resp;
 }
  public function getContact($contact_id, $organization_ID){ 
 	$query = $this->db->get_where('contacts',array('organization_ID' => $organization_ID, 'contact_ID'=>$contact_id));
 	return $query->result_array();


}

 public function getData($id){
 	$query = $this->db->get_where('contacts',array('organization_ID' => $id));
 	return $query->result_array();
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
  public function getValidationRules(){
  	return array(
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email',
    'errors' => array(
                        'required' => 'You must provide an %s.'
                )
        ),
        array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required|min_length[5]|max_length[15]|alpha',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide an %s.'
                )
        ),
        array(
                'field' => 'address',
                'label' => 'Street Address',
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
                'field' => 'type',
                'label' => 'Contact Type',
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
       
);
  }

}
?>