<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   

    <title>Project 3</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

     <!-- Custom styles for this template -->
    <link href="default.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
 <?
   php
  
    header('Content-Type: text/html; charset=ISO-8859-1');
?>

  <?php include('navigation.php'); ?>
  <body>
   <br>
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome to Assignment 3</h1>
        <h4>This is the third assignment for Shradha Nagesh Karandikar for CSE 5335</h4>
        </div>
    </div>

<br>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-sm-2">
          <h3><span class="glyphicon glyphicon-info-sign"></span> About Us</h3>
          <p>What this is all about and other stuff </p><br>
          <p><a class="btn btn-default" href="About.php" role="button"><span class="glyphicon glyphicon-link"></span>  Visit Page</a></p>
        </div>
        <div class="col-sm-2">
          <h3><span class="glyphicon glyphicon-list"></span> Artist List</h3>
          <p>Displays a list of artist names as links</p><br>
          <p><a class="btn btn-default" href="Part01_ArtistsDataList.php" role="button"><span class="glyphicon glyphicon-link"></span>  Visit Page</a></p>
        </div>
        <div class="col-sm-2">
          <h3><span class="glyphicon glyphicon-user"></span> Single Artist</h3>
          <p>Displays information for a single artist</p><br>
          <p><a class="btn btn-default" href="Part02_SingleArtist.php?id=19" role="button"><span class="glyphicon glyphicon-link"></span>  Visit Page</a></p>
        </div>
        <div class="col-sm-2">
          <h3><span class="glyphicon glyphicon-picture"></span> Single Work</h3>
          <p>Displays information for a single work</p><br>
          <p><a class="btn btn-default" href="Part03_SingleWork.php?workid=394" role="button"><span class="glyphicon glyphicon-link"></span>  Visit Page</a></p>
        </div>
        <div class="col-sm-2">
          <h3><span class="glyphicon glyphicon-search"></span> Search</h3>
          <p>Perform search on ArtWorks tables</p><br>
          <p><a class="btn btn-default" href="Part04_Search.php" role="button"><span class="glyphicon glyphicon-link"></span>  Visit Page</a></p>
        </div>
        
      </div>  
    </div>

  
    

   
  </body>
</html>
