<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
{
			
	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}
	
	$data['title'] = ucfirst($page); // Capitalize the first letter

	$json = file_get_contents('http://dev-gardenshift.rhcloud.com/Gardenshift/user_details/all');
	$data['beers'] = json_decode($json);
      
	
	$this->load->view('templates/header', $data);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/footer', $data);

}

}
