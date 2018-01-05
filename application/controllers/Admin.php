<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  var $TPL;
  var $org;
  var $ContactsModel;

  public function __construct()
  {
    parent::__construct(); 
    $this->load->model('HomeModel');
    $this->load->model('ProductsModel');
    $this->load->model('ContactsModel');
    if($this->userauth->validSessionExists()){

    $this->org = $this->HomeModel->getOrganization();
  }
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){

      $user = $this->HomeModel->getUser($_SESSION['user_id']);
      if ($user['role_ID']!=1){
        redirect('PortalHome/notAdmin');
      }
      else{ 
      if (($user['current_order_ID']!=null)&&($user['current_order_ID']!=0)){
      $co = $this->HomeModel->getOrder($user['current_order_ID']);
      if ($co[0]['status']=="open"){
        $this->TPL['current_order'] = $co;
        $this->TPL['activate'] = true;
              $this->TPL['current_orderJSON'] = json_encode($this->TPL['current_order']);
      }
      else{
        $this->TPL['activate'] = false;
      }

     
      }
      else{
        $this->TPL['activate'] = false;
      }
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->org;
    $this->TPL['contacts'] = $this->HomeModel->getContacts();
    $this->TPL['products'] = $this->ProductsModel->getData($this->TPL['org_details']['organization_ID']);
    $this->TPL['headerItem'] = "Name and Description";
    $this->TPL['headerQuantity'] = "Quantity";
    $this->TPL['headerSubtotal'] = "SubTotal";
    $this->template->showCustomApp('admin', $this->TPL);
      }
    }
    else{
    $this->template->show('home',$this->TPL);
    }

  }

  public function logout(){
    $this->userauth->logout();
  }

  public function getLineItems($order_id){
    $org_id = $this->org['organization_ID'];
    $result = $this->HomeModel->getLineItems($order_id);
    $order = array('lines' => $result );
    $SubTotal = 0.0;
    $total = 0.0;
    foreach ($result as $key => $value) {
      $SubTotal+= $value['line_sub_total'];
      $total += $value["line_total"];
    }
    $order['subtotal'] = $SubTotal;
    
    $order['success'] = $this->HomeModel->updateOrderTotal($SubTotal, $order_id);
    $order['total'] = $total;
  echo json_encode($order);
  }

  public function addLine($order_id,$prod_id,$qty){

    $prod = $this->ProductsModel->getProduct($prod_id[0],$this->org['organization_ID']);
    $result = $this->HomeModel->createLine($prod,$order_id,$qty);
    echo json_encode($result);
  }
  public function deleteLine($line_id){
    $resp = $this->HomeModel->deleteRecord($line_id);
    if ($resp=="success"){
      echo json_encode(array('success' => true));
    }
    else{
    echo json_encode(array('success' => flase, 'error'=>$resp));
    }
  }
  public function updateLine($updateID,$prod_id,$qty){
     $prod = $this->ProductsModel->getProduct($prod_id,$this->org['organization_ID']);
    $resp = $this->HomeModel->updateLine($prod,$updateID,$qty);
    if ($resp=="success"){
      echo json_encode(array('success' => true));
    }
    else{
    echo json_encode(array('success' => flase, 'error'=>$resp));
    }
  }
  public function buttonClick($prod_id,$order_id){
    $existingLine = $this->HomeModel->getLineItemsByProd($order_id,$prod_id);
    if (empty($existingLine)){
      $this->addLine($order_id,$prod_id,1);
    }
    else{
      $newQ = 1+$existingLine[0]['quantity'];
      $this->updateLine($existingLine[0]['line_item_ID'],$prod_id,$newQ);
    }   
  }
  public function newOrder($contact_id){
    $resultID = $this->HomeModel->createOrder($contact_id, $_SESSION['user_id']);
    $data = $this->HomeModel->updateUsersCurrentOrder($resultID,  $_SESSION['user_id']);
    $this->index();
  }
  public function getContactCurrentOrder($contact_id){
    $order = $this->HomeModel->findCurrentOrder($contact_id);
    if (empty($order)){
      $this->newOrder($contact_id);
    }
    else{
      $this->HomeModel->updateUsersCurrentOrder($order[0]['order_ID'],  $_SESSION['user_id']);
      $this->index();
    }
  }


}