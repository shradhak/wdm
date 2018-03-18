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
<body>

<div class="container">

 
 <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container">
                       <div class="navbar-header">
                            <a class="navbar-brand" href="#"><b>CheapBooks</b></a>
                        </div>
                    
                        <div id="navbar" class="collapse navbar-collapse">
                             <ul class="nav navbar-nav">
                                <li class="active"><a href="/Page2">Home</a></li>
                            </ul>
                                  
                           <div class="navbar-form navbar-right ">
                                   <b style="color: white">Welcome <?php echo session('active_user'); ?></b>&nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              
                                     
                                    <div class="logout">
                                         <form action="logout" method="POST">
                                            <input type="submit" name="logout" value="Logout" class="btn btn-primary">
                                         <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                         </form>
                                    </div>
                            </div>
                        </div> 
                    </div>
            </nav>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="search">
<?php
echo $msg;
?>
</div>
</div>
</body>
</html>
