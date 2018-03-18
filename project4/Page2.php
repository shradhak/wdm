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

    <?php 
            session_start();
             $stockArray=array();
            $stockAvailable=0;
            $flag=0;
            $aflag=0;
            $host="localhost";
            $user="root";
            $password="";
            $dbname="cheapbook";
            $db=mysqli_connect($host,$user,$password,$dbname);

            

                if($_SESSION["username"]) 
                {
                    $username=$_SESSION["username"];
                    $basketID=  $_SESSION["basketID"];
    ?>
                 <nav class="navbar navbar-inverse navbar-fixed-top">
                     <div class="container">
                       <div class="navbar-header">
                            <a class="navbar-brand" href="#"><b>CheapBooks</b></a>
                        </div>
                    
                        <div id="navbar" class="collapse navbar-collapse">
                             <ul class="nav navbar-nav">
                                <li class="active"><a href="customer.php">Home</a></li>
                            </ul>
                                  
                           <form class="navbar-form navbar-right " method="POST" >
                                   <b style="color: white">Welcome <?php print $username; ?></b>&nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                <div class="form-group">
                                
                                   <a href="Page3.php" >
                                     <div id="quant"> </div><span class="glyphicon glyphicon-shopping-cart"></span>

                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                     <input type="submit" class="btn btn-primary"  value="Logout"  name="logout" class="form-control">
                                
                            </form>
                            </div> 
                    </div>
                </nav>
    <?php
        }

    ?>
      

    <div class="container">
    <br>
    <br>
        <div class="jumbotron">
    
        <br>
      
        <form method="POST">
 
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control"/>
                <br>
                <input type="submit" name="author" value="Search By Author" class="btn btn-primary"/ >
                <input type="submit" name="title" value="Search By Book Title" class="btn btn-primary"/>
            </div>
        </form>

   
        </div>
     
                                 
    <?php


        if(isset($_POST['logout']))
        {

             unset($_SESSION["username"]);
             unset($_SESSION["password"]);
        
            header("location:customer.php");   
        }


        //Search by author
       
        if(isset($_POST['author']) && !empty($_POST['search']))
        {

    ?>
        <div class="row">
        <div class="col-sm-10">
        <div class="panel  panel-primary">

            
        

    <?php

            $search=$_POST['search'];
          
            $query="select * from author where name  like '%$search%'";
            $result = mysqli_query($db, $query);
            $rowcount=mysqli_num_rows($result);
            if(empty($rowcount))
            {
?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>No Search Results Found.Please Try Again!!</strong>
                </div>
<?php
            }
            else
            {
?>
            <table class="table table-bordered table-responsive table-hover">
         <div class="panel-heading"><h3>Search Book by Author Results </h3></div>

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
              while($row = mysqli_fetch_array($result))
              {
                    $ssn=$row['ssn'];
                    $query1="select * from writtenby where ssn=$ssn";
                    $result1=mysqli_query($db,$query1);
                    while($row1=mysqli_fetch_array($result1))
                    {
                        $ISBN=$row1['ISBN'];
                       // echo $ISBN;
                        $query2="select * from book INNER JOIN stocks ON book.ISBN=stocks.ISBN where book.ISBN=$ISBN";

                        $result=mysqli_query($db,$query2);
                         $rowcount=mysqli_num_rows($result);
                         if(empty($rowcount))
                         {
?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>No Search Results Found.Please Try Again!!</strong>
                            </div>   
<?php

                         }
                    
                        while($row=mysqli_fetch_array($result))
                        {
                            $ISBN=$row['ISBN'];
                            $title=$row['title'];
                            $number=$row['number'];
                            //echo $number;

                            if(empty($stockArray) && !empty($number))
                            {
                                array_push($stockArray, $ISBN);
                                $stockAvailable=$number;
                                $aflag=1;
                            }
                            elseif(!empty($number))
                            {
                                if (in_array($ISBN,$stockArray)) 
                                {
                                       $stockAvailable=$stockAvailable+$number;
                                       $aflag=0;
                                      // echo $stockAvailable;

?>

                                    <tr>
                                        <td>
                                            <?php print $row['ISBN'];?>
                                        </td>
                                        <td>
                                            <?php  print   $row['title'];?>
                                         </td>
                                        <td>
                                            <?php  print  $stockAvailable;?>
                                        </td>
                                        <td>
                                             <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                        </td>


                                    </tr>
<?php

                                }
                                else
                                {
                                    array_push($stockArray, $ISBN);
                                    $aflag=0;

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
                                         <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                    </td>


                                </tr>
                        
<?php
                                }
                            }
                            if($aflag == 1 && !empty($number))
                            {

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
                                         <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                    </td>


                                </tr>
                                    
                                

<?php

                            }
                        }
                    }

               
?>
                       
<?php

                    

              }
?>
            </table>
<?php } ?>
            </div>
            </div>
            </div>
           
<?php
        }


        //search by book name
        else if(isset($_POST['title']) && !empty($_POST['search']))
        {

?>
            <div class="row">
            <div class="col-sm-10">
            <div class="panel  panel-primary">


            
           
<?php

            $search=$_POST['search'];
            //echo $search;
            $query="select * from book where title  like '%$search%'";
            $result = mysqli_query($db, $query);
             $rowcount=mysqli_num_rows($result);
            if(empty($rowcount))
            {
            
?>
                 <div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h2><strong>No Search Results Found</strong></h2> 
                </div>
<?php
            }
            else
            {
?>
             <table class="table table-bordered table-responsive table-hover">
            <div class="panel-heading"><h3>Search Book by Title Results </h3></div>

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


            while($row = mysqli_fetch_array($result))
            {
                   
                    $ISBN=$row['ISBN'];
                    $query2="select * from book INNER JOIN stocks ON book.ISBN=stocks.ISBN where book.ISBN=$ISBN";
                    $result2=mysqli_query($db,$query2);
                    while($row2=mysqli_fetch_array($result2))
                    {
                        $ISBN=$row2['ISBN'];
                        $title=$row2['title'];
                      //  echo $title;
                        $number=$row2['number'];
                      //  echo $number;
                        if(empty($stockArray) && !empty($number))
                        {
                            array_push($stockArray, $ISBN);
                            $stockAvailable=$number;
                            $flag=1;

                        }
                        elseif(!empty($number)) 
                        {
                            if (in_array($ISBN,$stockArray)) 
                            {
                                    $stockAvailable=$stockAvailable+$number;
                                      // echo $stockAvailable;
                                    $flag=0;
?>

                                    <tr>
                                        <td>
                                            <?php print $row2['ISBN'];?>
                                        </td>
                                        <td>
                                            <?php  print   $row2['title'];?>
                                         </td>
                                        <td>
                                            <?php  print  $stockAvailable;?>
                                        </td>
                                        <td>
                                             <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                        </td>


                                    </tr>
<?php

                            }
                            else
                            {
                                array_push($stockArray, $ISBN);
                                $flag=0;
?>
                                 <tr>
                                    <td>
                                        <?php print $row2['ISBN'];?>
                                    </td>
                                    <td>
                                        <?php  print   $row2['title'];?>
                                    </td>
                                    <td>
                                        <?php  print  $row2['number'];?>
                                    </td>
                                    <td>
                                         <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                    </td>


                                </tr>
                        

<?php
                            }
                        }

                        if($flag==1 && !empty($number))
                         {
?>
                             <tr>
                                    <td>
                                        <?php print $row2['ISBN'];?>
                                    </td>
                                    <td>
                                        <?php  print   $row2['title'];?>
                                    </td>
                                    <td>
                                        <?php  print  $row2['number'];?>
                                    </td>
                                    <td>
                                         <input type="text" id="quantity" value="1" size="2" /><button isbn='<?php print $ISBN; ?>'  class="btn btn-primary btn-sm" name="addCart" id="addCart"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</button>
                                    </td>


                                </tr>
<?php

                         }   


                       
}
}
}                               // print $row2['title'];
?>
                                    
                                


    </table>
<?php } ?>
    </div>
    </div>
    </div>

<?php
   

        if(!empty($_GET["action"])) 
        {
            echo "hello1";
            switch($_GET["action"]) 
            {
                case "add":
                            echo "hello3";
                            if(!empty($_POST["quantity"]))
                             {
                                 $quantity=$_POST["quantity"];
                                 $query="select * from book where ISBN='" . $_GET["ISBN"] . "'";
                                 $result=mysqli_query($db,$query);
                                 $row=mysqli_fetch_array($result);
                                 $itemArray = array('ISBN' =>$row['ISBN'] ,'Title'=>$row['title'],'Quantity'=>$quantity,'Price'=>$row['price']);
                                 print_r(array_values($itemArray));



                            }
                break;
            }
        }  
     


   
       
?>
 
<script type="text/javascript">
        var quant=0;
       $("body").delegate("#addCart","click",function(e){
       // $("#addCart").click(function(e){
           // var quant=0;
            var quant1;
            e.preventDefault();
            $quantity=$("#quantity").val();
            $ISBN=$(this).attr('isbn');
             quant1=parseInt($quantity);
             quant=parseInt(quant)+quant1;
            $("#quant").text(quant);

            
            $.ajax({
                url:"addToCart.php",
                method:"POST",
                data:{ISBN:$ISBN,quantity:$quantity},
                success:function(data){
                  // alert(data);

                }

            });

        });

    
    

</script>

</div>
</div>
</html>
