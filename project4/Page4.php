<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   

    <title>Project 4</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <!-- Custom styles for this template -->
    <link href="default.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <?php include('navigation.php'); ?>
    <br>
    <br>
    <?php 
    		session_start();
            $host="localhost";
            $user="root";
            $password="";
            $dbname="cheapbook";
            $flag=0;
            $db=mysqli_connect($host,$user,$password,$dbname);
            
    ?>
     <div class="container">
        <div class="row">
        
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <form id="newuser" method="post" > 
           
                    <div class="panel panel-primary" id="newuser1">
             <div class="panel-heading">
             <div class="panel-title" style="text-align: center;">Register</div></div>
             <div class="panel-body" style="padding-top:30px">
                    
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" value="" placeholder="Enter Username" required >                                        
                        </div>
                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required >
                         </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input id="address" type="text" class="form-control" name="address" placeholder="Enter Address" required>
                         </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                             <input id="phone" type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" required >
                        </div>

                        <div style="margin-bottom: 30px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                             <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email Address" required="" >
                         </div>
                
                         <input type="submit" class="btn btn-primary" name="register" value="Register" id="register" />
        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

        
        if(isset($_POST["register"]))
        {
           

                $username=$_POST["username"];
                $password=$_POST["password"];
                $address=$_POST["address"];
                $phone=$_POST["phone"];
                $email=$_POST["email"];

                $query='insert into Customers values("'.$username.'","'. md5($password) . '","'.$address.'","'.$phone.'","'.$email.'")';
                $result=mysqli_query($db,$query);

        }
               

    ?>
                   
   


    <script type="text/JavaScript">

    $(document).ready(function() {
            $("#showMsg").hide();
            $("#register").click(function(){
              
                $("#showMsg").show();
                  $("#newuser").hide();
                  $("#newuser").hide();
              


            });

        });
    </script>

        <div class="row" id="showMsg">
        
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="alert alert-success " >
                                <h2><strong>Registration successful!!</strong></h2>

                    </div>
            </div>
        </div>
             




    
</html>
