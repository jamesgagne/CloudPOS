<?php
class HomeModel extends CI_Model{
 /*
 --contacts--   --line_items--    --products--
 first_name       product_ID        organization_ID
 last_name        order_ID          contact_ID
 organization_ID  tax_ID            name
 email            quantity          description
 website          line_sub_total    selling_rate
 company          line_total        frequently_used
 phone            line_item_ID

 --orders--     --taxes--
 order_ID       tax_ID
 date           name
 user_ID        rate
 contact_ID     organization_ID
 status 
 total
 current  

 */
public function getOrganization(){
    session_start(); 
    $org_id = $_SESSION['org_id'];
    $query = $this->db-> query("SELECT * FROM organizations WHERE organization_id=$org_id;");
      $result = $query->result_array();
      return $result[0];
}
public function getContacts(){
  $org = $this->getOrganization();
  $query = $this->db->get_where('contacts', array('organization_ID' => $org['organization_ID'])); 
  return $query->result_array();
}

public function deleteLineItem($id){
	$this->db->delete('line_items', array('line_item_ID' => $id)); 
	return "success"; 
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

 public function getOrder($id){
  $query = $this->db->get_where('orders',array('order_ID' => $id));
  return $query->result_array();
 } 
  public function findCurrentOrder($contact_id){
  $query = $this->db->get_where('orders',array('contact_ID' => $contact_id,'current'=>1));
  return $query->result_array();
 } 

  public function getUser($id){
  $query = $this->db->get_where('users',array('user_ID' => $id));
  $result = $query->result_array();
  return $result[0];

 } 
 public function getLineItems($order_id){
  $query = $this->db->get_where('line_items',array('order_ID' => $order_id));
  $result = $query->result_array();
  foreach ($result as $key => $value) {
    $query2 = $this->db->get_where('products',array('product_ID' => $value['product_ID']));
    $result2 = $query2->result_array()[0];
    $result[$key]['NameDesc'] = $result2['name'] ." ".$result2['description'];
  }
  return $result;
 } 
 public function getLineItemsByProd($order_id, $product_ID){
  $query = $this->db->get_where('line_items',array('order_ID' => $order_id, 'product_ID'=>$product_ID));
  $result = $query->result_array();
  return $result;
 }

 public function createLine($prod,$order_id,$qty){
    $data = array(
               'order_ID' => $order_id,
               'quantity' => $qty,
               'product_ID' => $prod[0]['product_ID'],
               'tax_ID' => 1,
               'line_sub_total' => $prod[0]['selling_rate'] * $qty,
               'line_total'=>0
            );

  $q = $this->db->insert('line_items', $data); 

  $new_line_id = $this->db->insert_id();

  return $new_line_id;

 }
  public function updateLine($prod,$updateID,$qty){
    $data = array(
               'quantity' => $qty,
               'product_ID' => $prod[0]['product_ID'],
               'line_sub_total' => $prod[0]['selling_rate'] * $qty
            );
    $this->db->where("line_item_ID", $updateID);
  $q = $this->db->update('line_items', $data); 

  return "success";

 }
 public function deleteRecord($id){
  $this->db->delete('line_items', array('line_item_ID' => $id)); 
  return "success"; 
}
public function createOrder($contact_ID, $user_id){
         date_default_timezone_set('America/Toronto');
  $date = date("Y-m-d H:i:s");
  $data = array(
               'contact_ID' => $contact_ID,
               'user_ID' => $user_id,
               'status' => "open",
               'date' => $date,
               'total' => 0,
               'current'=>1
            );

  $q = $this->db->insert('orders', $data); 

  $new_line_id = $this->db->insert_id();
  return $new_line_id;
}
public function updateUsersCurrentOrder($resultID,  $user_id){
  $data = array(
               'current_order_ID' => $resultID
            );
    $this->db->where("user_ID", $user_id);
  $q = $this->db->update('users', $data); 

  return $resultID;
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