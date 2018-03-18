<!DOCTYPE html>
<html>
<head>
	<title>Project 5</title>
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


<?php

		}
?>


	<div class="container">
    	<br>
    	<br>
        <div class="jumbotron">
    
        <br>
      
        <form method="POST" id="searchForm" action="<?=site_url('customer/search')?>" >
 
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control"/>
                <br>
                <input type="submit" id="author" name="author" value="Search By Author" class="btn btn-primary"/ >
                 <input type="submit" id="title" name="title" value="Search By Book Title" class="btn btn-primary" 
                 />
               
            </div>
        </form>

   
    </div>


<?php

	if(isset($noresult))
	{
?>
		 <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>No Search Results Found.Please Try Again!!</strong>
                            </div>  
<?php
	}


	if(isset($result))
	{
?>
	    <div class="row">
        <div class="col-sm-10">
        <div class="panel  panel-primary">
        <table class="table table-bordered table-responsive table-hover">
         <div class="panel-heading"><h3>Search Results </h3></div>

                                <tr>
                                    <th>
                                    
                                       <h4><strong> ISBN</strong> </h4>
                                      
                                    </th>
                                    <th>
                                       <h4><strong> Book Name</strong> </h4>
                                    </th>
                                    <th>

                                      <h4><strong> Number of Books Available</strong></h4>
                                     </th>
                                     <th>
                                     </th>
                                </tr>


<?php
			//print_r($result);
			foreach ($result as $i=>$row) 
			{
				$ISBN=$row['ISBN'];
				//echo $i;
				//echo $row['ISBN'];
				
?>
					 <tr>
                                        <td>
                                            <?php print $row['ISBN'];?>
                                        </td>
                                        <td>
                                            <?php  print   $row['title'];?>
                                         </td>
                                        <td>
                                            <?php  print  $row['number'];?>
                                        </td>
                                        <td>
                                             <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>' act='<?=site_url('customer/addCart')?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                        </td>


                                    </tr>

					
<?php
					   }
?>
</table>
</div>
</div>
</div>
</div>
<?php


	}
?>

<?php
    if(isset($emptySearch))
    {
?>
         <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>No Search Results Found.Please Try Again!!</strong>
                            </div>    
<?php
    }
?>
	
    <script type="text/javascript">

    //search by author
    $(document).ready(function(e){	
    	

    	 $("#author").click(function(e){
    	 	
    	 		//alert("fh");

    	 		//e.preventDefault();
    	 		var url=$(this).attr('action');
    	 		var postData=$(this).serialize();
    	 		$.post(url,postData,function(o){

    	 		},'json');

    	 });
    	


    	$("#title").click(function(e){
    	 	
    	 		//alert("hiii");
    	 		var url=$(this).attr('action');
    	 		var postData=$(this).serialize();
    	 		$.post(url,postData,function(o){

    	 		},'json');



    	 
    	});

    	 

    	//add to cart
        var quant=0;
       $("body").delegate("#addCart","click",function(e){
       // $("#addCart").click(function(e){
           // var quant=0;
           //alert("hi");
            var quant1;
            e.preventDefault();
            $quantity=$("#quantity").val();
            $ISBN=$(this).attr('isbn');
             quant1=parseInt($quantity);
             quant=parseInt(quant)+quant1;
            $("#quant").text(quant);
            var $url=$(this).attr('act');

            
            $.ajax({
                url:$url,
                method:"POST",
                data:{ISBN:$ISBN,quantity:$quantity},
                success:function(data){
                 // alert(data);

                }

            });

        });


       

    });

    
    

</script>

</body>
</html>