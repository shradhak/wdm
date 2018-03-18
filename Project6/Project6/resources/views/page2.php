<!DOCTYPE html>
<html>
<head>
    <title>Project 6</title>
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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');

        $('#myaccount-name').editable({
            type: 'text',
            title: 'Enter new name',
            params: {_token:token},
        });
    </script>

</head>
<body>



  <div class="container">
 <nav class="navbar navbar-inverse navbar-fixed-top">
                     <div class="container">
                       <div class="navbar-header">
                            <a class="navbar-brand" href="#"><b>CheapBooks</b></a>
                        </div>
                    
                        <div id="navbar" class="collapse navbar-collapse">
                             
                                  
                           <div class="navbar-form navbar-right ">
                                   <b style="color:white">Welcome <?php echo session('active_user'); ?></b>&nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   
                                   

                                   
                                <div class="form-group" style="display: inline-block;">
                                    <form id='basket' method="POST" action="shopBasket">
                                     <div id="quant">
                                          <?php
                                            $sum = 0;
                                            if(!session('bucket')){
                                                echo "<b style='color:white;'>".$sum."</b>";
                                            }else{
                                                $items = session('bucket');
                                                foreach ($items as $key => $value)
                                                {
                                                    $sum = $sum + $value;

                                                }
                                                  echo "<b style='color:white;'>".$sum."</b>";
                                              }

                                            ?>
                                     </div>  
                                     <input type="submit" name="SBasket" value="ShoppingBasket" class="btn btn-primary" style="float: left;">
                                      <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                      
                                </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                     
                                     <form action="logout" method="POST">
                                            <input type="submit" name="logout" value="Logout" class="btn btn-primary"            id="logout"  class="form-control" style="float:right;">
                                             <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                                     </form>
                                
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
</div>

<div class="container">
        <br>
        <br>
        <div class="jumbotron">
    
        <br>
      
        <form method="POST" id="search" action="search" >
 
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control"/>
                <br>
                <input type="submit" id="author" name="author" value="Search By Author" class="btn btn-primary"/ >
                 <input type="submit" id="title" name="title" value="Search By Book Title" class="btn btn-primary" 
                 />
                  <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
               
            </div>
        </form>

   
    </div>

    <div class="searchResult">
        <?php

        if(isset($_POST['search'])) {
            if(isset($qryResult)) 
            {
            $output = "<div class='row'>
                <div class='col-sm-10'>
                    <div class='panel  panel-primary'>
                                
                        <table class='table table-bordered table-responsive table-hover'>
                            <div class='panel-heading'><h3>Search Book by Author Results </h3></div>

                                    <tr>
                                        <th>
                                            <h4><strong> ISBN</strong> </h4>
                                      
                                        </th>
                                        <th>
                                            <h4><strong> Book Name</strong> </h4>
                                        </th>
                                        <th>
                                            <h4><strong> Year</strong></h4>
                                        </th>
                                        <th>
                                            <h4><strong> Price</strong></h4>
                                        </th>
                                        <th>
                                            <h4><strong> Publisher</strong></h4>
                                        </th>
                                        <th>
                                            <h4><strong>No. of Books Available</strong></h4>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
";
            foreach ($qryResult as $row) {
                if ($row->count > 0) {

                    $data['isbn'] = $row->isbn;
                    $data['title'] = $row->title;
                    $data['year'] = $row->year;
                    $data['price'] = $row->price;
                    $data['publisher'] = $row->publisher;
                    $data['in_stock'] = $row->count;
                    $_token = csrf_token();
                    $output .= "    <form id='AddToCart' action='addCart'  method='POST'>
                        <tr><td>" . $data['isbn'] . "</td>
                        <td>" . $data['title'] . "</td>
                        <td>" . $data['year'] . "</td>
                        <td>" . $data['price'] . "</td>
                        <td>" . $data['publisher'] . "</td>
                        <td>" . $data['in_stock'] . "</td>
                       <input type='hidden' value='" . $data['isbn'] . "' name='bookinfo'>
                        <td><input type='submit' class='btn btn-primary' value='Add to cart' name='addtocart'>
                        <input type='hidden' name='_token' value='$_token'>
                        </td>
                        </tr>
                        </form>";

                }
            }
            $output .= "</table>";

            echo $output;
            session(['searchResult'=>$output]);
            }
        }
        else{
            echo session('searchResult');
        }
        ?>
    </div>
    </div>
    </div>
    </div>
    </div>


<?php
    if(isset($nosearch))
    {
?>
        <div class="row" >
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>No Search Results Found.Please Try Again!!</strong>
                </div>
            </div>
        </div>    
<?php
    }
?>
    

</div>

</body>
</html>
