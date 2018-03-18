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
    <body>
    <div class="container">
  	
  	<?php 
    			if(isset($_POST['logout']))
                {

                    unset($_SESSION["username"]);
                    unset($_SESSION["password"]);
        
                    header("location:customer.php");   
                }


                session_start();
    			
    			$username=$_SESSION["username"];
                $basketID=$_SESSION["basketID"];
                
    			$host="localhost";
      	    	$user="root";
            	$password="";
            	//$cartArray=array();
            	$dbname="cheapbook";
            	$db=mysqli_connect($host,$user,$password,$dbname);
            	$total=0;
                $flag=0;


                if($_SESSION["username"]) 
                {
                    $username=$_SESSION["username"];

    ?>
            
                    <nav class="navbar navbar-inverse navbar-fixed-top">
                        <div class="container">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#">CheapBooks</a>
                            </div>

                            <div id="navbar" class="collapse navbar-collapse">
                             <ul class="nav navbar-nav">
                                <li class="active"><a href="customer.php">Home</a></li>
                            </ul>
                                       
                        
                    
                        
                           <form class="navbar-form navbar-right " method="POST" >
                                <b style="color: white">Welcome <?php print $username; ?></b>&nbsp;&nbsp;&nbsp;
                                <div class="form-group">
                                
                                   <a href="Page3.php" >
                                        <div id="quant"> </div>   <span class="glyphicon glyphicon-shopping-cart"></span>

                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="submit" class="btn btn-primary"  value="Logout"  name="logout" class="form-control">
                            </form> 
                            </div>
                        </div>
                    </nav>
           
<?php
}
?>
            <br>
            <br>

            

            <div class="row" id="itemDetails">
            <div class="col-sm-10">
            <form method="POST">
            <div class="panel  panel-primary" id="thide">
            <table class="table table-bordered table-responsive table-hover">
            <div class="panel-heading"><h3>Shopping Cart</h3></div>

                                <tr>
                                    <th>
                                    
                                       <h4><strong> ISBN</strong> </h4>
                                      
                                    </th>
                                    <th>
                                       <h4><strong> Book Name</strong> </h4>
                                    </th>
                                    <th>
                                        <h4><strong>Quantity</strong></h4>
                                    </th>
                                    <th>
                                         <h4><strong>Price</strong></h4>
                                    </th>
                                </tr>
<?php
                
            	

            	//get basketId from shopping basket for that user
            
            	//$query="select basketId from shoppingbasket where username='$username'";
            	//$result=mysqli_query($db,$query);
            	//while($row=mysqli_fetch_array($result))
            	//{
            	//	$basketID=$row["basketId"];
            		//echo $basketID;
            	//}


            	//get isbn and number of books addeed to cart from contains table
                //echo $basketID;
            	$query1="select * from contains where basketId='$basketID'";
            	$result1=mysqli_query($db,$query1);
            	while($row1=mysqli_fetch_array($result1))
            	{
            		
            		$ISBN=$row1["ISBN"];
            		$number=$row1["number"];

            		$query2="select * from book where ISBN='$ISBN'";
            		$result2=mysqli_query($db,$query2);
            		while($row2=mysqli_fetch_array($result2))
            		{

						$price=$row2["price"];            			
			?>
						<tr>
							<td>
								<?php print $row2["ISBN"] ;?>
							</td>
							<td>
								<?php print $row2["title"] ;?>
							</td>
							<td>
								<?php print $number ;?>
							</td>
							<td>
								<?php print $price; ?>
							</td>
						</tr>



			<?php        

					//total price
					$total+=$number*$price;
					//echo $total;

            		}

            		
            	}
            	//print "Total Amount = ".$total;
			?>
                <tr>
                    <td colspan="3" style="text-align: center;">
                         <h4><strong>Total Amount :</strong></h4>       
                    </td>
                    <td>
                        <h5><strong><?php print $total;?></strong></h5>
                    </td>
                </tr>
			
             </table>

             </div>
             <br>
             <br>
                <div class="col-sm-4 col-sm-offset-5">
              <input type="button" class="btn btn-success btn-lg btn-block" id="buy" size="5" value="Buy" name="buy"/>
                </div>
            </form>
             </div>
             </div>


			<script type="text/JavaScript">

				$("#buy1").click(function(){
					$.ajax({
                			url:"buyBook.php",
                			method:"POST",
                			success:function(data){
                    		
                                $flag=1;
                            
                }

            });
					



				});


                $(document).ready(function() {
                    $("#showMessage").hide();
                    $("#buy").click(function() {
                            $.ajax({
                            url:"buyBook.php",
                            method:"POST",
                            success:function(data){
                                //alert(data);
                                }
                        });
                        $("#showMessage").show();
                        $("#itemDetails").hide();
                    });
                    
                });
			</script>


            <div class="row" id="showMessage">
                <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="alert alert-success alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Books have been successfully purchased!!</strong>
                    </div> 
                </div>
            </div>

   		
  	</div>
</body>  
</html>
