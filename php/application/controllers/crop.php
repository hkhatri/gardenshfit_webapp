<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crop extends CI_Controller {
    
    

	public function index()
	{       
                   
                echo 'hello';
		
	}
        public function mycrops($frmusername='')
	{       
           
            
            $ch = curl_init("https://test-gardenshift.rhcloud.com/Gardenshift/user_details/".$frmusername);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $json_res = curl_exec($ch);
            curl_close($ch);
            $json_array = json_decode($json_res);
        
            $usercrops = $json_array->{'user_crops'};
            // print_r ($usercrops);
             $count = count($usercrops);
              $json_res1 = file_get_contents("https://test-gardenshift.rhcloud.com/Gardenshift/crop_details/all");
          
            $json_array = json_decode($json_res1);
            $cropcnt = count($json_array);
            global $array1;
            for($i=0;$i<$cropcnt;$i++)
            {
               
                $array1[$i] = $json_array[$i]->{'crop_name'};
            }
            $data['usercrops'] = $usercrops;
            $data['cropsarray'] = $array1;
             $data['username'] = $frmusername;
            
            $this->load->view('pages/crops_display', $data);
            
		
	}
        public function allcrops(){
            
            $ch = curl_init("https://test-gardenshift.rhcloud.com/Gardenshift/crop_details/all");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $json_res = curl_exec($ch);
            curl_close($ch);
            $json_array_allcrops = json_decode($json_res);
            
            // print_r ($usercrops);
                        
            $data['allcrops'] = $json_array_allcrops;
                        
            $this->load->view('pages/all_crops', $data);
            
        }
        public function addnewcrop(){
            
            $crop_name = $_POST['name'];
            $crop_description = $_POST['description'];
          // $crop_name = "spinach1";
         //   $crop_description = "dsadas";
            
            $ch = curl_init('https://test-gardenshift.rhcloud.com/Gardenshift/create_crop');

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "name=$crop_name&description=$crop_description");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            echo $result;
            curl_close($ch);
            $this->load->view('pages/all_crops', $result);
            
        } 
  
}
