<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  var $TPL;
  var $postErrors = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->model('HomeModel');
    $this->load->model('ProductsModel');
    $this->load->model('ContactsModel');
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
    $this->TPL['org_details'] = $this->getOrganization();
    $this->TPL['listing'] = $this->getAllProducts();
    $this->TPL['headerid'] = "Product ID";
    $this->TPL['headerfname']= "Name";
    $this->TPL['headerlname']= "Description";
    $this->TPL['headerphone']= "Purchase Rate";
    $this->TPL['headeremail']= "Selling Rate";
    $this->TPL['headerstock']= "Current Stock";
    $this->TPL['headersku']= "SKU";
    $this->TPL['headerupc']= "UPC";
    $this->TPL['headermpn']= "MPN";
    $this->load->view('products', $this->TPL);
    }
  }
    else{
    redirect('Home');
    }

  }
    public function loginuser()
  {
    $this->TPL['msg'] =
      $this->userauth->login($this->input->post("email"),
                             $this->input->post("password"));
      $this->TPL['loggedin'] = $this->userauth->validSessionExists();

    if($this->userauth->validSessionExists()){
    $this->TPL['org_details'] = getOrganization();
    $this->template->showCustomApp('home', $this->TPL);
    
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
  public function getAllProducts(){
    session_start(); 
    $org_id = $_SESSION['org_id'];
    $query = $this->db-> query("SELECT * FROM products WHERE organization_ID=$org_id;");
      $result = $query->result_array();
      return $result;
  }
    public function update($field){
  $query = $this->db-> query("update products set ".$field."='".$_POST['value']."' where product_ID=".$_POST['pk']);
  if ($query){
      header("Status:200") ;
      echo "ok";
  }
  else{
    header("Status:400");
    echo "bad request";
  }
  }
  public function addnew(){

  

    $org = $this->getOrganization();
    $_POST['validated'] = $this->validatePost();  
                  
    if($_POST['validated']){

        $resp = $this->addToDB();
        if ($resp['sucess']){
          $src = $_FILES['file']['tmp_name'];
          $destination  ="/home/student/000328298/public_html/private/CloudPOS/application/assets/img/" . $org['name'] ."/". $_FILES['file']['name'];
          copy($src, $destination);
        }
        $resp['validated'] = true;
        echo json_encode($resp);    
     }
    else{
      $resp = array();
        $resp['validated'] = false;
        $resp['sucess'] = false;
        $resp['errors'] = $this->postErrors;
        echo json_encode($resp);
      }              
    
  }
  public function addToDB(){
    $org = $this->getOrganization();
        $name = $this->input->post("name");
         $description = $this->input->post("description");
         $purchase_rate = $this->input->post("purchase_rate");
         $selling_rate = $this->input->post("selling_rate");
         $stock = $this->input->post("stock");
         $upc = $this->input->post("upc");
         $sku = $this->input->post("sku");
         $mpn = $this->input->post("mpn");
         $image = $_FILES['file']['name'];
         $org_id = $org['organization_ID'];
        $q = $this->db->conn_id->prepare("insert into products(organization_ID,name,description,image,purchase_rate,selling_rate,stock,upc,sku,mpn) VALUES ( ?,?,?,?,?,?,?,?,?,?)");
           $q->bind_param("ssssssssss",$org_id,$name, $description, $image,$purchase_rate,$selling_rate,$stock,$upc,$sku,$mpn); 
            if ($q->execute()){
              return array('sucess'=>true);
            }
            else{
              return array('sucess'=>false, 'error'=>$q->error);
            }
  }
  public function validatePost(){
    $flag = true;
    $stockInt = intval($this->input->post('stock'));
    $sellingFloat = floatval($this->input->post('selling_rate'));
    $BuyingFloat = floatval($this->input->post('purchase_rate'));
    if (($sellingFloat<0)||($sellingFloat==null)){
      $flag =false;
      $this->postErrors['selling_rate'] = "Selling Rate must be a valid number greater than 0";
    }
    if (($stockInt<0)||($stockInt==null)){
      $flag =false;
      $this->postErrors['stock'] = "Initial stock must be a valid number greater than 0";
    }
        if (($BuyingFloat<0) ||($BuyingFloat==null)){
      $flag =false;
      $this->postErrors['purchase_rate'] = "Purchase Rate must be a valid number greater than 0";
    }
    if (($this->input->post('name')=="")||($this->input->post('name')==null)){
      $flag=false;
      $this->postErrors['name'] = "Item name is required";
    }
    if (($this->input->post('description')=="")||($this->input->post('description')==null)){
      $flag=false;
      $this->postErrors['description'] = "Item desription is required";
    }
    if (($this->input->post('purchase_rate')=="")||($this->input->post('purchase_rate')==null)){
      $flag=false;
      $this->postErrors['purchase_rate'] = "Purchase Rate is required";
    }
    if (($this->input->post('selling_rate')=="")||($this->input->post('selling_rate')==null)){
      $flag=false;
      $this->postErrors['selling_rate'] = "Selling Rate is required";
    }
    if (($this->input->post('stock')=="")||($this->input->post('stock')==null)){
      $flag=false;
      $this->postErrors['stock'] = "Initial stock is required";
    }
    if (($this->input->post('upc')=="")||($this->input->post('upc')==null)){
      $flag=false;
      $this->postErrors['upc'] = "UPC is required";
    }
    if (($this->input->post('sku')=="")||($this->input->post('sku')==null)){
      $flag=false;
      $this->postErrors['sku'] = "SKU is required";
    } 
    if (($this->input->post('mpn')=="")||($this->input->post('mpn')==null)){
      $flag=false;
      $this->postErrors['mpn'] = "MPN is required";
    }
    if (!isset($_FILES['file'])){
      $flag = false;
      $this->postErrors['image'] = "Please upload an image for this product";
    }
    else{
    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP);
    
    $detectedType = exif_imagetype($_FILES['file']['tmp_name']);
    
    if (!in_array($detectedType, $allowedTypes)){
        $flag = false;
        $this->postErrors['image'] = "File must be of image type .jpeg .png or .bmp";

      }
    }
      if (!$flag){
        $_FILES=null;
      }
    return $flag;

  }
}