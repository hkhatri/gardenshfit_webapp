
<?php

class Message extends CI_Controller {
    
    public function mymessages($frmusername=''){
        
           
            $this->load->library('session');
           
            if($frmusername==$this->session->userdata('username')){
            $ch = curl_init("https://dev-gardenshift.rhcloud.com/Gardenshift/get_notification_unread/".$frmusername);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $json_res = curl_exec($ch);
            curl_close($ch);
           
            $json_array = json_decode($json_res);
            if(count($json_array) !=0)
            $unreadmsgs = $json_array->{'notifications_unread'};
            //$msgcount=count($usermessages);
            $data['unreadmsgs'] = $unreadmsgs;
            
            $ch1 = curl_init("https://dev-gardenshift.rhcloud.com/Gardenshift/get_notification_read/".$frmusername);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_HEADER, 0);
            $json_res1 = curl_exec($ch1);
            curl_close($ch1);
           
            $json_array1 = json_decode($json_res1);
           // print_r($json_array1);
            
           
            $readmsgs = $json_array1->{'notifications_read'};
            //$msgcount=count($usermessages);
            $data['readmsgs'] = $readmsgs;
            $data['username'] = $frmusername;
             $this->load->view('pages/messages', $data);
            }
            else{
                header('Location: http://localhost:8888');
            }
    }
    public function updatenotif(){
        $name = $_POST['name']; 
        session_start();
             $this->load->library('session');
           
            if($name==$this->session->userdata('username')){
            
            $timestamp = $_POST['timestamp'];
            $res=file_get_contents('https://dev-gardenshift.rhcloud.com/Gardenshift/update_notification_to_read/'.$name.'/'.$timestamp);
            echo $res;
            }
            else{
                header('Location: http://localhost:8888');
            }
            
       
    }
       public function deletenotif(){
           
            $name = $_POST['name'];
              session_start();
             $this->load->library('session');
           
            if($name==$this->session->userdata('username')){
            $timestamp = $_POST['timestamp'];
            $res=file_get_contents('https://dev-gardenshift.rhcloud.com/Gardenshift/delete_notification_unread/'.$name.'/'.$timestamp);
            echo $res;
            }
            else{
                header('Location: http://localhost:8888');
            }
    }
       public function deletenotif_read(){
           
            $name = $_POST['name'];
            session_start();
             $this->load->library('session');
           
            if($name==$this->session->userdata('username')){
            $timestamp = $_POST['timestamp'];
            $res=file_get_contents('https://dev-gardenshift.rhcloud.com/Gardenshift/delete_notification_read/'.$name.'/'.$timestamp);
            echo $res;
            }
            else{
                header('Location: http://localhost:8888');
            }
       
    }
    public function sendreply(){
            $username = $_POST['username'];
            $type = $_POST['type'];
            $from = $_POST['from'];
            $text = $_POST['text'];
            $url = 'http://dev-gardenshift.rhcloud.com/Gardenshift/send_notification';
           
            session_start();
             $this->load->library('session');
           
            if($from==$this->session->userdata('username')){
            $body = 'username='.$username.'&type='.$type.'&from='.$from.'&text='.$text;
            $c = curl_init ($url);
            curl_setopt ($c, CURLOPT_POST, true);
            curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
            curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);

            $page = curl_exec ($c);
            curl_close ($c);
            $url1 = 'http://dev-gardenshift.rhcloud.com/Gardenshift/add_bulletin';
            $body1 = 'username='.$username.'&text= '.$from.' sent you a message';
            $c1 = curl_init ($url1);
            curl_setopt ($c1, CURLOPT_POST, true);
            curl_setopt ($c1, CURLOPT_POSTFIELDS, $body1);
            curl_setopt ($c1, CURLOPT_RETURNTRANSFER, true);

            $page = curl_exec ($c1);
            curl_close ($c1);
           
            }
            else{
                header('Location: http://localhost:8888');
            }
            
    }
    
    
    public function send_new_message(){
            $username = $_POST['username'];
            $type = $_POST['type'];
            $from = $_POST['from'];
            $text = $_POST['text'];
            $url = 'http://dev-gardenshift.rhcloud.com/Gardenshift/send_notification';
           
            session_start();
             $this->load->library('session');
           
            if($from==$this->session->userdata('username')){
            $body = 'username='.$username.'&type='.$type.'&from='.$from.'&text='.$text;
            $c = curl_init ($url);
            curl_setopt ($c, CURLOPT_POST, true);
            curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
            curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);

            $page = curl_exec ($c);
            curl_close ($c);
            $url1 = 'http://dev-gardenshift.rhcloud.com/Gardenshift/add_bulletin';
            $body1 = 'username='.$username.'&text= '.$from.' sent you a message';
            $c1 = curl_init ($url1);
            curl_setopt ($c1, CURLOPT_POST, true);
            curl_setopt ($c1, CURLOPT_POSTFIELDS, $body1);
            curl_setopt ($c1, CURLOPT_RETURNTRANSFER, true);

            $page = curl_exec ($c1);
            curl_close ($c1);
           
            }
            else{
                header('Location: http://localhost:8888');
            }
            
    }
}
?>