<?php
class UsersModel extends CI_Model{
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
  $this->db->delete('users', array('user_ID' => $id)); 
}

public function createRecord($post){
$data = array(
               'first_name' => $post['first_name'],
               'last_name' => $post['last_name'],
               'email' => $post['email'],
               'phone' => $post['phone'],
               'sin' => $post['sin'],
               'role_ID' => $post['type'],
               'organization_ID' => $post['organization_ID'],
               'pay_rate'=> $post['pay_rate'],
               'salt' => $post['salt'],
               'hash' => $post['storedVal']

            );
$q = $this->db->insert('users', $data); 
$new_cont_id = $this->db->insert_id();
  return $new_cont_id;
}
public function updateRecord($post){
  $data = array(
               'first_name' => $post['first_name'],
               'last_name' => $post['last_name'],
               'email' => $post['email'],
               'phone' => $post['phone'],
               'sin' => $post['sin'],
               'role_ID' => $post['type'],
               'pay_rate'=> $post['pay_rate']
            );

$this->db->where('user_ID', $post['user_ID']);
$this->db->update('users', $data); 
  
}


  public function getContact($contact_id, $organization_ID){ 
  $query = $this->db->get_where('users',array('organization_ID' => $organization_ID, 'user_ID'=>$contact_id));
  return $query->result_array()[0];

}

 public function getData($id){
  $query = $this->db->get_where('users',array('organization_ID' => $id));
  return $query->result_array();
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
                'field' => 'sin',
                'label' => 'SIN',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        
        array(
                'field' => 'type',
                'label' => 'User Type',
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
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
    )
        ),
        array(
                'field' => 'confpassword',
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
  }
public function getEditValidationRules(){
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
                'field' => 'sin',
                'label' => 'SIN',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.'
                )
        ),
        
        array(
                'field' => 'type',
                'label' => 'User Type',
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