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
   <div class="container">
    
      <?php
        if(isset($_GET['workid']))
        {
          $workid = $_GET['workid'];
        }
        else{
           header('Location: Error.php');  
        }
    
       // print $workid;
        $host="localhost";
        $user="root";
        $password="";
        $dbname="art";
        $db=mysqli_connect($host,$user,$password,$dbname);
        $query = "select * from artworks where artworks.ArtWorkID=$workid"; 
        mysqli_query($db, $query) or die(header("Location: Error.php"));

        $result = mysqli_query($db, $query);
    
        $row = mysqli_fetch_array($result) or die(header("Location: Error.php"));

        $artistID=$row['ArtistID'];
        $query2 = "select * from artists INNER JOIN artworks ON artists.ArtistID=artworks.ArtistID where artists.ArtistID=$artistID AND artworks.ArtWorkID=$workid";

        $result2 = mysqli_query($db, $query2);
    
        $row = mysqli_fetch_array($result2);
        ?>
        <div class="row">
        <div class="col-md-4">
        <?php
         print '<h2>'.$row['Title'].'</h2>';
          print '<h6>By  '.'<a href="Part02_SingleArtist.php?id='.$row['ArtistID'].'">'.$row['FirstName'].' '.$row['LastName'].'</a></h6>';

        ?>
        </div>
        </div>
         <div class="row">
        <div class="col-md-4">
        <?php
         
         
         print '<a href="#" data-toggle="modal" data-target="#image-modal" data-title="'.$row['FirstName'].'">'.
          '<img src="images/art/works/medium/'.$row['ImageFileName'].'.jpg" class="img-thumbnail" alt="No Thumbnail" class="img-responsive" width="324px" height="600px" > 

         </a>';


        
        ?>
          </div>

                      

                                       <div id="image-modal"  class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-md">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
        
                                                       <?php
                                                        print '<h5 class="modal-title"><b>'.$row['Title'].'('.$row['YearOfWork'].')   by    '.$row['FirstName'].' '.$row['LastName'] .'</b></h5>';
                                                        ?>
                                                  </div>
                                                  <div class="modal-body">
                                                     <?php
                                                          print  '<img src="images/art/works/medium/'.$row['ImageFileName'].'.jpg"  alt="No Thumbnail" class="img-responsive"  width="600px" height="800px"/>';

                                                     ?>
                                                   </div>
                                                  <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>

                                      

        <div class="col-md-5">
        <?php
          print '<p>'.$row['Description'].'</p>';
          $cost=$row['Cost'];
          $cost=number_format($cost, 2, '.', '');
          print '<h3 class="cost" style="color: red"><b> $'.$cost.'</b></h3>';
          ?>
            <div class="btn-group">
              <button type="button" class="btn btn-default ">
                  <a href="#">
                   <span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>
               </button>
             <button type="button" class="btn btn-default ">
                  <a href="#">
                   <span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
                </button>
            </div>
            <br>
            <br>
            <div class="panel panel-default">
              <table class="table ">
                <div class="panel-heading">
                  <h3><b> Product Details </b></h3>
                </div>
                <tr>
                  <td>
                   <b> Date  :</b>
                   </td>
                   <td>
                    <?php
                        print $row['YearOfWork'];
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                   <b> Medium  :</b>
                   </td>
                   <td>
                     <?php
                        print $row['Medium'];
                    ?>

                  </td>
                </tr>
                <tr>
                  <td>
                    <b>Dimensions  :</b>
                    </td>
                    <td>
                    <?php
                      print $row['Width'].'cm X '.$row['Height'].'cm';
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                   <b> Home  :</b>
                    </td>
                    <td>
                     <?php
                        print $row['OriginalHome'];
                    ?>

                  </td>
                </tr>
                 <tr>

                  <td>
                    <b>Genres  :</b>
                  </td>
                  <td>
                     <?php

                      $query3 = "select * from artworkgenres WHERE ArtWorkID=$workid";
                       $result3 = mysqli_query($db, $query3);
    
                        while($row = mysqli_fetch_array($result3)){

                            $genreid=$row["GenreID"];
                            $query4="select * from genres where GenreID=$genreid";
                             $result4 = mysqli_query($db, $query4);
                             $row1 = mysqli_fetch_array($result4);
                             print '<a href="#">'.$row1['GenreName'].'</a><br>'; 


                        }



                        
                    ?>

                  </td>


                </tr>

                <tr>

                  <td>
                   <b> Subjects  :</b>
                  </td>
                  <td>
                     <?php

                      $query5 = "select * from artworksubjects WHERE ArtWorkID=$workid";
                       $result5 = mysqli_query($db, $query5);
    
                        while($row = mysqli_fetch_array($result5)){

                            $subjectId=$row["SubjectID"];
                            $query6="select * from subjects where SubjectId=$subjectId";
                             $result6 = mysqli_query($db, $query6);
                             $row2 = mysqli_fetch_array($result6);
                             print '<a href="#">'.$row2['SubjectName'].'</a><br>'; 


                        }



                        
                    ?>

                  </td>


                </tr>

                





                
              </table>

</div>



      
      </div>
     <div class="col-md-3">
      <div class="panel panel-info">
        <table class="table">
            <div class="panel-heading">
                
                  <a href="#">Sales</a><br>
                
            </div>
            <tr>
                <td>
                  <a href="#">
                    <?php
                      $query7 = "select * from orderdetails WHERE ArtWorkID=$workid";
                      $result7 = mysqli_query($db, $query7);
    
                      while($row = mysqli_fetch_array($result7)){
                        $orderId=$row["OrderID"];
                        $query8="select * from orders where OrderID=$orderId";
                        $result8 = mysqli_query($db, $query8);
                        $row2 = mysqli_fetch_array($result8);
                        $date=date_create($row2['DateCreated']);
                        $date=date_format($date,"n/j/Y");
                        print '<a href="#">'.$date.'</a><br><br>';
                            


                      }
                    ?>

                  </a>

                </td>
            </tr>

        </table>

     </div>

     
</div>

   </div>
  </body>
</html>