<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   

    <title>Project 5</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <!-- Custom styles for this template -->
    <link href="default.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	
	<?php include('navigation_view.php'); ?>
        
    <br>
    <br>
    <br>
    <br>
    <br>
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

			    		<form id="login" method="post" class="form-signin" > 
           
        					
			    			 	<div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" name="username" value="" placeholder="Username" >                                        
                                </div>
                                
                            	<div style="margin-bottom: 30px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
          

        					
        
       			 				<div style="margin-top:10px;display: inline-block;"  id="block" class="form-group">
                                	
       			 						<input type="submit" style="float: left;" class="btn btn-success" id="login" name="login" value="Login"/>
       			 						&nbsp;&nbsp;
       			 					
       			 				
						</form><form method="POST" action="<?=site_url('customer/newuser')?>" style="float:right;"><button  class="btn btn-primary" name="newuser" id="newuser" type="submit">New users must register here </button></form>
                        </div>
    				</div>
    			</div>																																																																	
    		</div>
    	</div>
    </div>fl

<?php
        //invalid user validation
        if(isset($invalidUser))
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

        //empty user or pass

        if(isset($emptyUser))
        {
?>
            <div class="row" >
                <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Please enter username and password to shop books!!</strong>
                     </div>
                </div>
            </div>
<?php
        }
?>

    <script type="text/javascript">
      $("body").delegate("#newuser","click",function(e){
        //alert("hii");
        var url=$(this).attr('action');
       
         $.ajax({
                url:url,
                method:"POST",
              
                success:function(data){
                 //alert("success");

                }

            });

      });
    </script>


   
</body>
</html>