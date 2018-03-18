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
    </head>
    <?php include('navigation_view.php'); ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</head>
<body>

<div class="container">
    <div class="row">
        
        <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form action="userRegister" method="POST" class="register" id="register">
           
                <div class="panel panel-primary" id="newuser1">
                <div class="panel-heading">
                <div class="panel-title" style="text-align: center;">Register</div></div>
                <div class="panel-body" style="padding-top:30px">
                <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                           <input type="text" required="required" name="username" id="username" placeholder="Enter Username" oninvalid="this.setCustomValidity('Username cannot be blank')" class="form-control">                                      
                        </div>
                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                           <input type="password" required="required" name="password" id="password" placeholder="Enter Password" oninvalid="this.setCustomValidity('Password cannot be blank')" class="form-control">
                         </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                           <input type="text" required="required" name="address" id="address" placeholder="Address" oninvalid="this.setCustomValidity('Address cannot be blank')" class="form-control">
                         </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                             <input type="text" required="required" name="phone" id="phone" placeholder="Phone" oninvalid="this.setCustomValidity('Phone cannot be blank')" class="form-control">
                        </div>

                        <div style="margin-bottom: 30px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                             <input type="email" required="required" name="email" id="email" placeholder="Email" oninvalid="this.setCustomValidity('Email cannot be blank')" class="form-control">
                         </div>

                         <input type="submit" value="Register" name="register" class="btn btn-primary">
                            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">

                </form>
</div>
</div>
</div>

</body>
</html>