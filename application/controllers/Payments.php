<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

  var $TPL;
  var $org;
  var $ContactsModel;

  public function __construct()
  {
    parent::__construct(); 
    $this->load->model('HomeModel');
    $this->load->model('ProductsModel');
    $this->load->model('ContactsModel');
    $this->load->model('InvoicesModel');
    if($this->userauth->validSessionExists()){

    $this->org = $this->HomeModel->getOrganization();
  }
  }

  public function index()
  {
    if($this->userauth->validSessionExists()){

      $user = $this->HomeModel->getUser($_SESSION['user_id']);
      if (($user['current_order_ID']!=null)&&($user['current_order_ID']!=0)){
      $co = $this->HomeModel->getOrder($user['current_order_ID']);
      $this->TPL['current_order']  = $co;
      $this->TPL['current_orderJSON'] = json_encode($this->TPL['current_order']);
      $this->TPL['activate'] = true;
      }
      else{
        $this->TPL['activate'] = false;
      }
      $this->TPL['taxes'] = $this->InvoicesModel->getTaxes();
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->TPL['org_details'] = $this->org;
    $this->TPL['contacts'] = $this->HomeModel->getContacts();
    $this->TPL['orders'] = $this->InvoicesModel->getOrders($co[0]['contact_ID']);
    $this->TPL['products'] = $this->ProductsModel->getData($this->TPL['org_details']['organization_ID']);
    $this->TPL['headerItem'] = "Name and Description";
    $this->TPL['headerQuantity'] = "Quantity";
    $this->TPL['headerSubtotal'] = "SubTotal";
    $this->template->showCustomApp('payments', $this->TPL);
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

  public function makeOrderCurrent($id, $contact_ID){
    $this->HomeModel->updateUsersCurrentOrder($id,  $_SESSION['user_id']);
    $this->InvoicesModel->updateContactsCurrentOrder($id,  $contact_ID);
      $this->index();
  }
  public function formSubmit(){
    $strPas = $this->org['merchant_id']. ":" .$this->org['access_code'];
    $baseEncoded = base64_encode($strPas);
    $url = "https://api.na.bambora.com/v1/payments";
    //$url = "https://www.beanstream.com/api/v1/payments";
    //$url = "http://beanstream.requestcatcher.com/";
    $order = $this->InvoicesModel->getOrder($_POST['order_ID'])[0];
    $cont = $this->ContactsModel->getContact($order['contact_ID'],$this->org['organization_ID'])[0];
    $address = $this->ContactsModel->getAddress($cont['contact_ID']);
    $contName = $cont['first_name']." ".$cont['last_name'] ;
    $expiry_month = substr($_POST['exp'], -2);
    $expiry_year = substr($_POST['exp'], -5,2);
    $billingAddress = array('name' => $contName,'address_line1'=>$address['address'], 'postal_code'=>$address['postal'] );
    $paymentArray = array('billing' => $billingAddress  );
    
    if ($_POST['type']!="Cash"){
      $paymentArray['payment_method'] = "card";
      $cardInfo = array('name' => $contName, 'number'=>$_POST['card'], 'expiry_month'=> $expiry_month ,'expiry_year'=> $expiry_year, 'cvd'=> $_POST['cvd'] );
      $paymentArray ['card'] = $cardInfo;
    }
    else{
      $paymentArray['payment_method'] = "cash";
    }

    $paymentArray['amount'] = $_POST['hidAmt'];
    $headerArray = array('Authorization' => "Passcode " . $baseEncoded, 'Content-Type'=>'application/json' );
    $header = json_encode($headerArray);
    $data = json_encode($paymentArray);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data),
      'Authorization:Passcode ' . $baseEncoded)                                                                      
);   
    $result = curl_exec($ch);
    
      
      echo $result;
      
    
   
    
   
    
  }
  public function updatPaid(){
    $this->InvoicesModel->updateOrderPaid($_POST['paymentID'],  $_POST['order_ID']);
    $this->HomeModel->updateUsersCurrentOrder(NULL,  $_SESSION['user_id']);
    $this->InvoicesModel->updateContactsCurrentOrder(NULL,  $_POST['contact_ID']);
    echo "success";
  }


}