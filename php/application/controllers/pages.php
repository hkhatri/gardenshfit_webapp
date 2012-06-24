<?php

class Pages extends CI_Controller {

	public function index()
{
			
	$json = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/crop_details/all');
	$data['crops'] = json_decode($json);
  	$this->load->view('pages/home.php', $data);
	

}


public function test()
{
        $name = $_POST['username'];
        
        $json1 = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/user_details/'.$name);
        $data['result'] = json_decode($json1);

//        $persons = array();
//
//            for ($i=0; $i<count($users); $i++)      
//                array_push($persons, $users[$i]->username);     
//
//        if(count($persons) > 0)
//        {
//            $data['result'] = "Username avaialable";
//            $this->load->view('pages/test.php', $data);
//        }
        
        if($data['result'] == null)
            $data['status']  = '1';
        else
            $data['status']  = '0';
       
        $this->load->view('pages/test.php', $data);
  		
}

}
