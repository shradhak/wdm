    <br>
    <br>
    <?php 
    		
    		$host="localhost";
      	    $user="root";
            $password="";
            $dbname="cheapbook";
            $basketID=0;
            $db=mysqli_connect($host,$user,$password,$dbname);
			
    ?>
    <br>
    <br>
    <div class="container">
   		<div class="row" >
   			<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
   				 <div class="panel panel-info" >
   				 	<div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>

                     <div style="padding-top:30px" class="panel-body" >

			    		<form id="login" method="post" class="form-signin"> 
           
        					
			    			 	<div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="" placeholder="Username" >                                        
                                </div>
                                
                            	<div style="margin-bottom: 30px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
          

        					
        
       			 			<div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
       			 					<input type="submit" class="btn btn-success" name="login" value="Login"/>
       			 					&nbsp;&nbsp;<button class="btn btn-primary" name="newuser" >New users must register here</button>
       			 				</div>
       			 			</div>


       			 			
    					</form>
    				</div>
    	</div>																																																																																																									
    	</div>
    	</div>
    </div>

    <?php
    
	$error=''; // Variable To Store Error Message
	if (isset($_POST['login'] ))
	 {
		
		if (empty($_POST['username']) || empty($_POST['password'])) 
		{
			
		?>
			
			<div class="row" >
   				<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="alert alert-danger alert-dismissable fade in">
   						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    					<strong>Please Enter Username and Password or Register to Login </strong>
 					 </div>
 				</div>
 			</div>
    		
  <?php
	 	}
		else
		{
			// Define $username and $password
			session_start(); // Starting Session
			$username=$_POST['username'];
			$password=$_POST['password'];
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
				// To protect MySQL injection for Security purpose
			//echo $username;
			//$username = mysqli_real_escape_string($username);
			//$password = mysqli_real_escape_string($password);
			// Selecting Database
			
			$query = "select * from customers where password='".md5($password)."' AND username='$username'";
          	mysqli_query($db, $query) or die(header("Location: Error.php"));

          	$result = mysqli_query($db, $query);
			if ($row = mysqli_fetch_array($result)) 
			{
				//$_SESSION['login_user']=$username; // Initializing Session
				//header("location: profile.php"); // Redirecting To Other Page
					$_SESSION["username"] = $row["username"];
					$_SESSION["password"] = $row["password"];


					$query="select basketId from shoppingbasket order by basketId desc limit 1";
					$result=mysqli_query($db,$query);
					$row=mysqli_fetch_array($result);
					$basketID=$row["basketId"];
					$basketID=$basketID+ 1;
					$_SESSION["basketID"]=$basketID;
					$query1="INSERT INTO shoppingbasket(basketId,username) values ('$basketID','$username')";
					mysqli_query($db,$query1);
					header("location: Page2.php"); // Redirecting To Other Page
				
				echo "Login Successful!!";
			}
			else 
			{

			?>

			<div class="row" >
   				<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="alert alert-danger alert-dismissable fade in">
   						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    					<strong>Username or Password is Invalid..Please Try Again!!</strong>
 					 </div>
 				</div>
 			</div>
  			
  			<?php
			}
			
		}
	}


	if (isset($_POST['newuser'] ))
	{
	
		header("location: Page4.php"); 
		


	}
?>

