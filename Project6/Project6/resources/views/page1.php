<?php
session_start();
$errorMsg	= '';

if(isset($_SESSION['currUser']) && $_SESSION['currUser'] != '') {
	header("location:page2.php");
} else {
	if(isset($_SESSION['errorMsg']) && $_SESSION['errorMsg'] != '') {
		$errorMsg = $_SESSION['errorMsg'];
		unset($_SESSION['errorMsg']);
	}
}

if(isset($errorMsg) && $errorMsg != '') {
	echo $errorMsg;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   

    <title>Project 6</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <!-- Custom styles for this template -->
    <link href="default.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
  

</script>

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

    <div id="loginform">

        <div class="row" >
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >

                        <form id="login" method="post" class="form-signin" action="login" style="display: inline-block;"> 
           
                            
                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text"  class="form-control" name="username" id="username" placeholder="Enter Username" oninvalid="this.setCustomValidity('Username cannot be blank')">
                                </div>
                                <div style="margin-bottom: 30px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password"  class="form-control" name="password" id="password" placeholder="Enter Password" oninvalid="this.setCustomValidity('Password cannot be blank')">
                                </div>
                                <div style="margin-top:10px;display: inline;" class="form-group">
                                   
                                        <input type="submit" style="float: left;" class="btn btn-success" id="login" name="login" value="Login" 
                                        onclick="return validate()"/>
                                         <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                        &nbsp;&nbsp;
                                  
                                
                        </form>
                        <form method="POST" action="register">
                            <button  class="btn btn-primary" name="register" id="register" style="float: right;margin-bottom: 20px" type="submit">New users must register here</button>
                             <input type="hidden" name="_token"  value="<?php echo csrf_token();?>">
                        </form>
                        </div>
                    </div>
                </div>

                <?php
                    if (isset($invalid)) 
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
                ?>


                   
<?php
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
            </div>
        </div>
    </div>
</div>
                                    
</body>
</html>