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
<div class="container">
<?php
	
		$username=$this->session->userdata('username');
		//echo $username;
		if(!empty($username))
		{
?>
			 <nav class="navbar navbar-inverse navbar-fixed-top">
                     <div class="container">
                       <div class="navbar-header">
                            <a class="navbar-brand" href="#"><b>CheapBooks</b></a>
                        </div>
                    
                        <div id="navbar" class="collapse navbar-collapse">
                             <ul class="nav navbar-nav">
                                <li class="active"><a href="<?=site_url('customer/page2')?>">Home</a></li>
                            </ul>
                                  
                          
                            <div class="navbar-form navbar-right ">
                                   <b style="color: white">Welcome <?php print $username; ?></b>&nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                <div class="form-group" style="display: inline-block;">
                                
                                   <a href="<?=site_url('customer/page3')?>" style="float: left;">
                                     <div id="quant"> </div><span class="glyphicon glyphicon-shopping-cart" style="margin-top: 10px"></span>

                                    </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <form method="POST" action="<?=site_url('customer/logout')?>" style="float: right;">
                                     <input type="submit" class="btn btn-primary" id="logout"  value="Logout"  name="logout" class="form-control">
                                
                            </form>
                           

                            </div> 
                    </div>
                </nav>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>


<?php

		}
?>

<?php

		if(isset($page3Data))
		{
            $quant=0;
?>
				
            <div class="row" id="itemDetails">
            <div class="col-sm-10">
           
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
				foreach ($page3Data as $i=>$row) 
				{
						$ISBN=$row['ISBN'];
						$title=$row['title'];
						$number=$row['number'];
						$price=$row['price'];
						$total=$row['total'];
                        $quant=$quant+$number;
						if(empty($total))
						{
?>
							<tr>
								<td>
									<?php print $ISBN;?>
								</td>
								<td>
									<?php print $title ;?>
								</td>
								<td>
									<?php print $number ;?>
								</td>
								<td>
									<?php print $price; ?>
								</td>
							</tr>
                            <script type="text/javascript">
                   $("#quant").text("<?php echo $quant ;?>");
                </script>



<?php
						}
						else
						{
?>
							<tr>
                   				 <td colspan="3" style="text-align: center;">
                        			 <h4><strong>Total Amount :</strong></h4>       
                    			</td>
             			       <td>
                        			<h5><strong><?php print $total;?></strong></h5>
                    			</td>
                			</tr>
<?php

						}

				}
?>
		 </table>

             </div>
             <br>
             <br>
                <div class="col-sm-4 col-sm-offset-5">
                <form method="POST" action="<?=site_url('customer/buyBook')?>">
                <input type="hidden" id="one" value="test"/>
              <button type="submit" class="btn btn-success btn-lg btn-block" id="buy" size="5"  name="buy"  
              >Buy</button>
              </form>
                </div>

                
            
             </div>
             </div>

<?php

		}

		if(isset($show))
		{

?>
			 <div class="row" id="showMessage">
                <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="alert alert-success alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Books have been successfully purchased!!</strong>
                    </div> 
                </div>
            </div>

           

<?php
		}

?>

<script type="text/JavaScript">

				
		
					$url=$(this).attr('action');
                  
                    $("#buy").click(function() {
                            $.ajax({
                            url:$url,
                            method:"POST",
                            success:function(data){
                              //  alert("success");
                                }
                        });
                       
                        $("#itemDetails").hide();
                    });
                    
                



			$("#logout").click(function(e){
            var url=$(this).attr('log');
            $.ajax({
                url:url,
                method:"POST",
              
                success:function(data){
                 // alert(data);

                }

            });


       

        });

</script>
</div>
</body>
</html>