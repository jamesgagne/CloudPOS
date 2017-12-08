<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $username;
    private $password;
    private $org_id;
    private $user_id;

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "index.php?/PortalHome";
      $this->logout_page = base_url() . "index.php?/Home";
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($username,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage']);
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($username, $password) == false)
      {
         return "Username/password fields cannot be blank!";
      }
        
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase() == false)
      {
        return 'Invalid username/password!';
      }
      else
      { 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
	$this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin() 
    {

      session_start();     
   
      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }
       
		 
      // Access Control List checking goes here..
      // Does user have sufficient permissions to access page?
      // Ex. Can a bronze level access the Admin page?   

  
      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['username']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($username, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($username) == false) && (empty($password) == false) )
      {
        $this->username = $username;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify username and password with MySQL database.
    */
    public function userIsInDatabase() 
    {

      $CI =& get_instance();
      $query = $CI->db->query("Select * from users where email ='".$this->username."'");
      $result = $query->result_array();
      
      // Access database to verify username and password from database table
      if (isset($result[0]['email']))  
      {
        $storedVal = $result[0]['hash'];
        $salt = $result[0]['salt'];

        $encPass = sha1($this->password);
         
         $inputVal = sha1($encPass.$salt); 


        if ($storedVal==$inputVal){
          $this->accesslevel = $result[0]['role_id'];
          $this->frozen =  false;
          $this->org_id = $result[0]['organization_ID'];
          $this->user_id = $result[0]['user_ID'];
        return true;
      }
      } 
      else 
      {
        return false; 
      }
    }
    
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write username and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accesslevel'] = $this->accesslevel;
        $_SESSION['basepage'] = base_url() . "index.php?/PortalHome";
        $_SESSION['org_id'] = $this->org_id;
        $_SESSION['user_id'] = $this->user_id;
        
    }
	
    /**
    * @return string
    * @desc Username getter, not necessary 
    */
    public function getUsername() 
    {
        return $_SESSION['username'];
    }
		 
}
