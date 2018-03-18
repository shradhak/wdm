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
  <?php
  
    header('Content-Type: text/html; charset=ISO-8859-1');
?>
  <?php include('navigation.php'); ?>
  <body>
   
   <?php
    if(isset($_GET['id'])){
   		$id = $_GET['id'];
    }
    else{
       header('Location: Error.php');  
    }
		

		$host="localhost";
		$user="root";
		$password="";
		$dbname="art";
		$db=mysqli_connect($host,$user,$password,$dbname);
		$query = "SELECT * FROM artists where ArtistID=$id";
		mysqli_query($db, $query) or die(header("Location: Error.php"));

		$result = mysqli_query($db, $query);
		
		$row = mysqli_fetch_array($result) or die(header("Location: Error.php"));
	//rint  '<a href="Part02_SingleArtist.php?id='.$row['ArtistID'].'">'.$row['FirstName'] .' '.$row['LastName'].'  '.'('.$row['YearOfBirth'].'-'.$row['YearOfDeath'].')'.'</a> <br/>';
		
		
	?>


		<div class="container">
		<?php
       				print '<h2>'.$row['FirstName'] .' '.$row['LastName'].'</h2>';
       	?>	
		  <div class="row">
       			<div class="col-sm-4">

    				<?php
    					print '<img src="images/art/artists/medium/'.$row["ArtistID"].'.jpg" class="img-thumbnail" alt="No thumbnail">' ;
    				?>
					
				</div>
				<div class="col-sm-6">                                  
					<?php
						print '<p>'.$row['Details'].'</p>';

					?>

					 <button type="button" class="btn btn-default ">
       					  <a href="#">
       					   <span class="glyphicon glyphicon-heart"></span> Add to Favourites List</a>
      				  </button>
      				  <br/>
      				  <br>
            <div class="panel panel-default">
      				<table class="table  table-responsive" >

              <div class="panel-heading ">
      					<h3><b> Artists Details<b></h3>
              </div>
              
                  <tr>
      						<td class="td1">
      							<b>Date:</b>
                  </td>
                  <td class="td1s">
                  	<?php
      								print  $row['YearOfBirth'].'-'.$row['YearOfDeath'];
      							?>
      						</td>

      					</tr>
      					<tr>
      						<td>
      							<b>Nationality:</b>
                  </td>
                  <td>
                  <?php
      								print $row['Nationality'];
      							?>
      						</td>

      					</tr>
      					<tr>
      						<td>
      						<b>	More Info :</b>
                  </td>
                  <td>
      							<?php
      								$info=$row['ArtistLink'];
      								print '<a href="'.$info.'">'.$info.'</a>';


      							?>
      						</td>
      					</tr>
               
      					
      				</table>
              </div>
				</div>
			</div>
		
		<br>

		<?php
			print '<h3> Art By'.'  '.$row['FirstName'] .' '.$row['LastName'].'</h3>';

			$query2= "SELECT * FROM artworks where ArtistID=$id";
			mysqli_query($db, $query) or die(header("Location: Error.php"));

			$result = mysqli_query($db, $query2);
		?>
		 <div class="row row-eq-height">
    		<?php
				while($row = mysqli_fetch_array($result)){

			?>
					    <div class="col-sm-2 panel panel-default allworks">
					    	<div class="panel-body" >


					   <?php
		
						print	'<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<img src="images/art/works/square-thumbs/'.$row["ImageFileName"].'.jpg" class="img-thumbnail" alt="No thumbnail">'.'</a><br>';
       				
       					 print '<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<h5>'.$row["Title"].','.$row["YearOfWork"].'</h5></a>';
       					 
       					
                         print'<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'" class="btn btn-primary btn-xs">
     							 <span class="glyphicon glyphicon-info-sign"></span>View
   						 </a>';

   						 ?>
   						  <a href="#" class="btn btn-success btn-xs">
     							 <span class="glyphicon glyphicon-gift"></span>Wish
   						 </a>
   						  <a href="#" class="btn btn-info btn-xs">
     							 <span class="glyphicon glyphicon-shopping-cart"></span>Cart					
     					 </a>
     					 </div>

       				</div>
       					 	<?php

           			}


		?>

			

       		
       		</div>





		</div>




 		
		
		
	




    

   
  </body>
</html>
