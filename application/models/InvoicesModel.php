<?php
class InvoicesModel extends CI_Model{
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
public function getOrders($contID){
  $org = $this->getOrganization();
  $query = $this->db->get_where('orders', array('contact_ID'=>$contID)); 
  $res = $query->result_array();
  
    return $res;

}
public function getAllOrders($contID){
    $org = $this->getOrganization();
  $query = $this->db->get_where('orders', array('contact_ID'=>$contID)); 
  $res = $query->result_array();
  
    return $res;

}
public function getAllOrganizationOrders(){
    $allOrders = array();
    $org = $this->getOrganization();
    $usersq = $this->db->get_where('users', array('organization_ID' => $org['organization_ID'] ));
    $users = $usersq->result_array();
    foreach ($users as $key => $value) {
      $q = $this->db->get_where('orders', array('user_ID'=>$value['user_ID'])); 
      array_push($allOrders, $q->result_array());
    }
  
    return $allOrders;

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

public function updateUsersCurrentOrder($resultID,  $user_id){
  $data = array(
               'current_order_ID' => $resultID
            );
    $this->db->where("user_ID", $user_id);
  $q = $this->db->update('users', $data); 

  return $resultID;
}
public function updateContactsCurrentOrder($resultID,  $contact_ID){
  $data = array(
               'current' => 0
             );
    $this->db->where("contact_ID", $contact_ID);
    $this->db->where("current", 1);
    $q = $this->db->update('orders', $data); 
    $data = array(
               'current' => 1
             );
    $this->db->where("order_ID", $resultID);
    $q = $this->db->update('orders', $data);

  return $resultID;
}
public function getTaxes(){
  $query = $this->db->get('taxes');
  return $query->result_array();

}
public function updateOrderPaid($str, $order_ID){
  $data = array(
               'paymentInfo' => $str,
               'status' => 'paid'
             );
    $this->db->where("order_ID", $order_ID);
    $q = $this->db->update('orders', $data); 
}
  
}
?>