<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
 
  <?php include('navigation.php'); ?>
   <?php
  
    header('Content-Type: text/html; charset=ISO-8859-1');
?>
  <body>
   <div class="container">
   <h1>Artists Data List(Part 1)</h1>
  
   <hr>
   <?php
  		  $host="localhost";
	     	$user="root";
		    $password="";
    		$dbname="art";
    		$db=mysqli_connect($host,$user,$password,$dbname);
    		$query = "SELECT * FROM artists ORDER BY LastName";
    		mysqli_query($db, $query) or die('Error querying database.');

    		$result = mysqli_query($db, $query);
    		//$row = mysqli_fetch_array($result);

    		while ($row = mysqli_fetch_array($result)) {
     		//echo $row['first_name'] . ' ' . $row['last_name'] . ': ' . $row['email'] . ' ' . $row['city'] .'<br />';
    		 print  '<a href="Part02_SingleArtist.php?id='.$row['ArtistID'].'">'.$row['FirstName'] .' '.$row['LastName'].'  '.'('.$row['YearOfBirth'].'-'.$row['YearOfDeath'].')'.'</a> <br/>';
  			
  			//echo $row['LastName'];
  		//print  '<a href="Part02_SingleArtist.php?id='.$row['ArtistID'].'>'.$row['FirstName'] .' '.$row['LastName'].'  '.'('.$row['YearOfBirth'].'-'.$row['YearOfDeath'].')'.'</a>'.' <br/>';



       	}

	?>


    

   </div>
  </body>
</html>
