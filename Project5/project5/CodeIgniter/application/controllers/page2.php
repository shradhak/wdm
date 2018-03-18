<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
		
	class Page2 extends CI_Controller 
	{
		

		function __construct()
     	{
        
         	parent::__construct();
	        $this->load->library('session');
	        $this->load->helper('form');
	        $this->load->helper('url');
	        $this->load->helper('html');
	        $this->load->database();
	        $this->load->library('form_validation');
	          //load the login model
	        
	    }

	    function page()
	    {
	    	$this->load->view('Page2_view');
	    }
	}
?>