<?php
session_start();

$host="localhost";
$user="root";
$password="";
$dbname="cheapbook";
$db=mysqli_connect($host,$user,$password,$dbname);


$ISBN=$_POST["ISBN"];
$quantity=$_POST["quantity"];
$username=$_SESSION["username"];
$basketID=$_SESSION["basketID"];
//echo $quantity;
//echo $username;
//echo $ISBN;
echo $basketID;

//get basket Id
//$query="SELECT basketId FROM shoppingbasket WHERE username='$username'";
//$result=mysqli_query($db,$query) or die("error");
//while($row=mysqli_fetch_array($result)){
//$basketID=$row["basketId"];
//echo $basketID;


//get number of books already in cart

$query1="select number from contains where ISBN='$ISBN' AND basketId='$basketID'";
$result=mysqli_query($db,$query1) or die("error");
$count=0;
while($row=mysqli_fetch_array($result)){
	$count=$row["number"];
	
}

$number=mysqli_num_rows($result);

if($number>0)
{
	$count=$count+$quantity;	
	$query="update contains SET number=$count where ISBN='$ISBN' AND basketId='$basketID'";
	mysqli_query($db,$query) or die("error");
	//echo($count);
}
else{
	$query="INSERT INTO contains(ISBN,basketId,number) VALUES ($ISBN,$basketID,$quantity)";
	mysqli_query($db,$query) or die("error");

}







?>