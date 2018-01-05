<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

  var $TPL;
  var $org;
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

  public function index($id)
  {
    $this->load->view('invoice',$this->TPL);

  }
    public function getInvoice($id)
  {
    $this->TPL['org_details'] = $this->org;
    $this->TPL['org_address'] = $this->HomeModel->getOrgAddress($this->org['organization_ID']);
    $order = $this->InvoicesModel->getOrder($id)[0];
    $this->TPL['order'] = $order;
    $this->TPL['cont'] = $this->HomeModel->getContact($order['contact_ID'], $this->org['organization_ID'])[0];
    $this->TPL['contAddress'] = $this->HomeModel->getAddress($this->TPL['cont']['contact_ID']);
    $this->TPL['items'] = $this->HomeModel->getLineItems($order['order_ID']);
    $this->load->view('invoice',$this->TPL);

  }
  public function showInvoice($id){
    $this->TPL['org_details'] = $this->org;
    $this->TPL['org_address'] = $this->HomeModel->getOrgAddress($this->org['organization_ID']);
    $order = $this->InvoicesModel->getOrder($id)[0];
    $this->TPL['order'] = $order;
    $this->TPL['cont'] = $this->HomeModel->getContact($order['contact_ID'], $this->org['organization_ID'])[0];
    $this->TPL['contAddress'] = $this->HomeModel->getAddress($this->TPL['cont']['contact_ID']);
    $this->TPL['items'] = $this->HomeModel->getLineItems($order['order_ID']);
    $this->template->showCustomApp('invoice', $this->TPL);
  }

    
}