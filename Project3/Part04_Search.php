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
  <?php header('Content-Type: text/html; charset=ISO-8859-1');?>

 
  <body>
  

  
    <div class="container">
      <?php 
        $nofilter=null;
        $host="localhost";
        $user="root";
        $password="";
        $dbname="art";
        $db=mysqli_connect($host,$user,$password,$dbname);

      ?>

        <h2>Search Results</h2>
        <hr>
        <div class="jumbotron">

          <form method="POST"   >
 
            <div class="form-group">
              <div class="radio">
                <label><input type="radio" name="search" value="title" id="radio1">Filter By Title</label><br/>
              
                <input type="text" id="title" class="form-control" name="title"/>
                <input type="hidden" id="tit" value="" />
              </div>
              <div class="radio">
                <label><input type="radio" name="search" value="description">Filter By Description</label><br/>
                <input type="text" id="description" class="form-control"/>
              
              </div>
              <div class="radio">
                <label><input type="radio" name="search" value="nofilter">No Filter(show all ArtWorks)</label>
                <input type="hidden" id="nofilter" class="form-control" value="" />
              </div>

              <input type="submit" class="btn btn-primary" id="filterbtn" value="Filter" name="submit">
            </div>

        </div>


 
        <script type="text/javascript">

            $(document).ready(function () { 
              var title;
              var all=null;
              $("#title").hide();
              $("#description").hide();
              $("#nofilter").hide();
              $("input[name='search']").click(function () {
               
                var value = this.value;
                console.log(value);
                if (value == 'title') {
                   console.log(value);
                   all=null;
                  $("#title").show();
                } 
                else{
                   $("#title").hide();
                }

                if (value == 'description') {
                   console.log(value);
                   all=null;
                   console.log(all);
                  $("#description").show();
                } 
                else{
                   $("#description").hide();
                }
                if (value == 'nofilter') {
                   //console.log(value);
                   all="nofilter";
                  //$("#nofilter").show();
                } 
                else{
                   $("#nofilter").hide();
                   all=null;

                }
                
              });

              $("#filterbtn").click(function(e){

                 title=$("#title").val();

                 description=$("#description").val();
                
                 document.cookie = "headvalue="+title+"-"+description+"-"+all;
              
                // document.cookie = "descValue="+description;
              /*  $.ajax({
                          type: 'GET',
                          url:'Part04_Search.php',
                          data:("description="+description),
                          success: function(data) {
                             
                           alert(data);
                        }
                                    
                       
                     });
                    return false;*/

               
              
               });




            });

          



        </script>
        <?php
             $str="cookie";
             $parts="";
             $parts[0]="";
             $parts[1]="";
            
             $nofilter=0;
            if(isset($_COOKIE["headvalue"])){
            $str=$_COOKIE["headvalue"];
            
 
             $parts = explode("-", $str);
            $title=$parts[0];
            $description=$parts[1];
            $nofilter=" ";
            $nofilter=$parts[2];
          //  echo $nofilter;

             unset($_COOKIE["headvalue"]);
            }
  
  //$description=$_COOKIE["descValue"];

 
      if(isset($_POST['submit'])){
            
       

        //title
        if(!empty($title))
        {

          $query = "SELECT * FROM artworks where Title like '%$title%'";
          $title="";
         $nofilter="";
          mysqli_query($db, $query) or die(header("Location: Error.php"));

          $result = mysqli_query($db, $query);

          while($row = mysqli_fetch_array($result)){
          ?>

          <div class="row">
                <div class="col-md-2">
                <?php
                 print '<br>';
                  print '<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<img src="images/art/works/square-medium/'.$row["ImageFileName"].'.jpg" class="img-thumbnail" alt="No thumbnail" width="200" height="200">'.'</a>';
                ?>


                </div>
                <div class="col-md-10">
                <?php
                  print '<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<h2>'.$row["Title"].'</h2>'.'</a>';
                  
                  print $row["Description"];
                  ?>
                </div>
              </div>
            <?php 
              } //title while loop end
            }  //title ends

             if(!empty($description)){

              $query1 = "SELECT * FROM artworks where Description like '%$description%'";
              $keyword=$description;
              $description="";
               $nofilter="";
              mysqli_query($db, $query1) or die(header("Location: Error.php"));

              $result1 = mysqli_query($db, $query1);

              while($row1 = mysqli_fetch_array($result1)){
              ?>
               <div class="row">
                <div class="col-md-2">
                 <?php
                  //print $row1["ArtWorkID"];
                 print '<br>';
                  print '<a href="Part03_SingleWork.php?workid='.$row1["ArtWorkID"].'">'.'<img src="images/art/works/square-medium/'.$row1["ImageFileName"].'.jpg" class="img-thumbnail" alt="No thumbnail" width="200" height="200">'.'</a>';
                ?>


                </div>
                <div class="col-md-10">
                <?php
                  print '<a href="Part03_SingleWork.php?workid='.$row1["ArtWorkID"].'">'.'<h2>'.$row1["Title"].'</h2>'.'</a><br>';
                  
                 
                  $descText=$row1["Description"];
                  $descText = preg_replace("/\w*?$keyword\w*/i","<mark>$0</mark>",$descText);
                  print $descText;
                  ?>
                </div>
              </div>




              <?php

              } //description while ends
             } //description ends

             if(!empty($nofilter)){
                $nofilter=null;
                 $query2 = "SELECT * FROM artworks";
                 $nofilter="";
                 mysqli_query($db, $query2) or die(header("Location: Error.php"));

                  $result2 = mysqli_query($db, $query2);
                    while($row2 = mysqli_fetch_array($result2)){

                    ?>
                     <div class="row">
                <div class="col-md-2">
                 <?php
                  //print $row1["ArtWorkID"];
                  print '<br>';
                  print '<a href="Part03_SingleWork.php?workid='.$row2["ArtWorkID"].'">'.'<img src="images/art/works/square-medium/'.$row2["ImageFileName"].'.jpg" class="img-thumbnail" alt="No thumbnail" width="200" height="200">'.'</a>';
                ?>


                </div>
                <div class="col-md-10">
                <?php
                  print '<a href="Part03_SingleWork.php?workid='.$row2["ArtWorkID"].'">'.'<h2>'.$row2["Title"].'</h2>'.'</a><br>';
                  
                 
                  print $row2["Description"];
                  ?>
                </div>
              </div>
                    <?php
               
          
             
             }
             }
             }


            
                       ?>
            
              
  </form>

<?php 
  if(isset($_GET["title"])){


      
 
  $tit=$_GET["title"];
 
?>
   <script type="text/javascript">

            $(document).ready(function () { 
            var tit="<?php echo $tit; ?>";
              $("#radio1").prop("checked", true);

              $("#title").show();

                $("#title").val(tit);
              $("#description").hide();
              $("#nofilter").hide();



           
  });

  </script>
  <?php 

         $query = "SELECT * FROM artworks where Title like '%$tit%'";
          mysqli_query($db, $query) or die(header("Location: Error.php"));

          $result = mysqli_query($db, $query);

          while($row = mysqli_fetch_array($result)){
?>
        <div class="row">
                <div class="col-md-2">
                <?php
                 print '<br>';
                  print '<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<img src="images/art/works/square-medium/'.$row["ImageFileName"].'.jpg" class="img-thumbnail" alt="No thumbnail" width="200" height="200">'.'</a>';
                ?>


                </div>
                <div class="col-md-10">
                <?php
                  print '<a href="Part03_SingleWork.php?workid='.$row["ArtWorkID"].'">'.'<h2>'.$row["Title"].'</h2>'.'</a>';
                  
                  print $row["Description"];
                  ?>
                </div>
              </div>
            <?php 
              } //title while loop end
          



      
} //if ends
  ?>
  
   </div>
         
  </body>
</html>
          

           