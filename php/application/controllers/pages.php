<?php

class Pages extends CI_Controller {
 
	public function index()
{			
  	$this->load->view('pages/home.php');	
}


public function adduser()
{
        $name = $_POST['username'];
        
        $json = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/user_available/'.$name);
        $data['result'] = json_decode($json);
        
        if($data['result'] == null)
            $data['status']  = '1';
        else
            $data['status']  = '0';
       
        $this->load->view('pages/adduser.php', $data);
  		
}

public function authenticate()
          
{
  
        $this->load->library('session');
        session_start();
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
       
        
        
        // Calls in Web service to check whether the provided credentials exist or not
        
        $url = 'http://dev-gardenshift.rhcloud.com/Gardenshift/authenticate';
        // The submitted form data, encoded as query-string-style
        // name-value pairs
        
        $body = 'username='.$username.'&password='.$password;
        $c = curl_init ($url);
        curl_setopt ($c, CURLOPT_POST, true);
        curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
        curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
        
        $page = curl_exec ($c);
        curl_close ($c);
        
        
        // Calls in web service to display all the information of all the users in order to see which all crops are being grown
        
        
        
        if($page == "true")
        {         
           
           $this->session->set_userdata('username', $username);
           //$_SESSION['username'] = $username;
           $this->load->view('pages/main.php');                 
        }
        else echo 'Invalid username or password';
            
  	
}


public function logout()
{
    $this->load->library('session');
     
    $this->session->set_userdata('username', '');
    
    $this->load->view('pages/home.php');
}

public function get_userdata()
{
    $this->load->library('session');
    $username =  $this->session->userdata('username');
       
    $json = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/user_available/'.$username);
    $result = json_decode($json);

    echo $json;
}

public function post_userdata()
{
    
    // Need to add functionality in web service to change password
    $this->load->library('session');
    
    $username =  $this->session->userdata('username');
    
   // $password = $_POST['user_password'];
    $email = $_POST['email'];
    $zip = $_POST['zipcode'];
    $name = $_POST['name'];
    
    
    $url = 'http://dev-gardenshift.rhcloud.com/Gardenshift/updateuser';
    // The submitted form data, encoded as query-string-style
    // name-value pairs

    $body = 'username='.$username.'&email='.$email.'&zip='.$zip.'&name='.$name;
    
    $c = curl_init ($url);
    curl_setopt ($c, CURLOPT_POST, true);
    curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
    curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);

    $page = curl_exec ($c);
    curl_close ($c);

    $this->load->view('pages/main.php');
}

public function get_crops(){
    
     $crops = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/user_details/all');
     
     echo $crops;
       
}


public function get_mapdata(){
    
        
    $zipcode = $_POST['crop_zipcode'];
    $distance = $_POST['crop_distance'];
    $crop = $_POST['crop_name'];
    
    $crops = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/search/'.$zipcode.'/'.$distance.'/'.$crop);
     
    echo $crops;
       
}

}
