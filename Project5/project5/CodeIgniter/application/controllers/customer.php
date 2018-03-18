<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
		
	class Customer extends CI_Controller 
	{
		

		public function __construct()
     	{
        
         	parent::__construct();
	        $this->load->library('session');
	        $this->load->helper('form');
	        $this->load->helper('url');
	        $this->load->helper('html');
	        $this->load->database();
	        $this->load->library('form_validation');
	          //load the login model
	        $this->load->model('customer_model');
	    }

		public function index()
		{
			
			 //get the posted values
            $username = $this->input->post("username");
            $password = $this->input->post("password");


              //set validations
            $this->form_validation->set_rules("username", "Username", "trim|required");
            $this->form_validation->set_rules("password", "Password", "trim|required");

          	if ($this->form_validation->run() == FALSE)
          	{
               //validation fails
                $msg["emptyUser"]="emptyUser";
               	$this->load->view('customer_view',$msg);
          	}
          	else
          	{
               //validation succeeds
               if ($this->input->post('login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->customer_model->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
                         //set the session variables
                         $basketID = $this->customer_model->get_basket($username);
                         $sessiondata = array(
                              'username' => $username,
                              'basketID'=>$basketID,
                              'loginuser' => TRUE
                         );
                         $this->session->set_userdata($sessiondata);
                         //echo "success";
                       //$this->load->view('Page2_view');
                       // $this->load->library('/controllers/Page2');
                       // $this->Page2->index();
                        // redirect('page2/page','refresh');
                        // $this->output->set_content_type("application/json")->set_output(json_encode(array('status'=>true, 'redirect'=>site_url('customer/page2') )));
                         $this->page2();
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         $msg["invalidUser"]="invalid";
                         $this->load->view('customer_view',$msg);
                        //redirect('controllers/Page2/index/');
                    }
               }
               else
               {
                   // redirect('Page2');
               	echo "error";
               }
    		}
    	}



      public function page2()
      {
       
       $this->load->view('Page2_view');
       
      }

       public function page3()
      {
       
        $data=$this->customer_model->post_page3Data();
        
        $msg['page3Data']=$data;
       $this->load->view('Page3_view',$msg);
       
      }

      public function search()
      {
        $search=$this->input->post("search");
        if(empty($search))
        {
          $msg['emptySearch']=0;
                $this->load->view('Page2_view',$msg);
        }
        else
        {
            $ssn=$this->customer_model->getAuthor($search);
            if(!empty($ssn))
            {
                $data=$this->customer_model->getbooks_byAuthor($search);
                if(empty($data))
                {

                     $msg['noresult']=0;
                    $this->load->view('Page2_view',$msg);
                 }
                else
                {
                //print_r($data);
                    $msg['result']=$data;
                    $this->load->view('Page2_view',$msg);
                }
            }
            else
            {
                 $data=$this->customer_model->getbooks_byTitle($search);
                if(empty($data))
                {

                    $msg['noresult']=0;
                    $this->load->view('Page2_view',$msg);
                }
                else
                {
                //echo count($data);
                     $msg['result']=$data;
                    $this->load->view('Page2_view',$msg);
                }
            }
        }

        

    }





      public function addCart()
      {
        
        //echo "hi";
        $ISBN=$this->input->post('ISBN');
        $quantity=$this->input->post('quantity');
       $data=$this->customer_model->get_addCart($ISBN,$quantity);
       //echo $data;
      }


      public function buyBook()
      {
        $flag=$this->customer_model->get_buyBook();
        if($flag==1)
        {
             $msg['show']="success";
            $this->load->view('Page3_view',$msg);
      //echo "hi";
        }


      }


      //logout
      public function logout()
      {
        $this->session->unset_userdata('username');

        //echo "hi";
        redirect("http://localhost/project5/CodeIgniter/");

      }


      //newuser
      public function newuser()
      {
         //   echo "string";
          $this->load->view('Page4_view'); 
      }


      //register user
      public function registeruser()
      {
        $username=$this->input->post("username");
        $password=$this->input->post("password");
        $address=$this->input->post("address");
        $email=$this->input->post("email");
        $phone=$this->input->post("phone");
        $this->customer_model->register_newuser($username,$password,$address,$email,$phone); 
        $basketID = $this->customer_model->get_basket($username);
                         $sessiondata = array(
                              'username' => $username,
                              'basketID'=>$basketID,
                              'loginuser' => TRUE
                         );
                         $this->session->set_userdata($sessiondata);
        //$msg['register']="success";

        //$this->load->view('Page4_view',$msg);
        redirect("customer/page2");

      }
    







  }




 ?>

































































