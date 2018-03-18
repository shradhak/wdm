<?php

				session_start();
    			$username=$_SESSION["username"];
    			$host="localhost";
      	    	$user="root";
            	$password="";
            	$flag=0;
            	//$cartArray=array();
            	$dbname="cheapbook";
            	$db=mysqli_connect($host,$user,$password,$dbname);

            	$username=$_SESSION["username"];
            	$basketID=$_SESSION["basketID"];
				echo $basketID;

				//get basket Id
				//$query="SELECT basketId FROM shoppingbasket WHERE username='$username'";
				//$result=mysqli_query($db,$query) or die("error");
				//while($row=mysqli_fetch_array($result))
				//{
				//	$basketID=$row["basketId"];
					//echo $basketID;

				//}
				//get number of books already in cart

				$query1="select * from contains where basketId='$basketID'";
				$result=mysqli_query($db,$query1) or die("error");

				while($row=mysqli_fetch_array($result))
				{
					$ISBN=$row["ISBN"];
					$quantity=$row["number"];


					//get warehousecode and number of books available in that warehouse from stock table

					$query2="select * from stocks where ISBN='$ISBN'";
					$result=mysqli_query($db,$query2) or die("error");

					while($row=mysqli_fetch_array($result))
					{
						$warehouseCode=$row["warehouseCode"];
						$number=$row["number"];

						if(!empty($number) && $quantity>$number)
						{
							$quantity=$quantity-$number;
							//update stocks
							$query3="update stocks SET number=0 where warehouseCode='$warehouseCode' AND ISBN='$ISBN'";
							mysqli_query($db,$query3);

							//insert into shipping order
							$query4="INSERT INTO shippingorder(ISBN,warehouseCode,username,number) values ('$ISBN','$warehouseCode','$username','$number')";
							mysqli_query($db,$query4) or die("error");
							$flag=1;
						}

						elseif (!empty($number) && $number>=$quantity) 
						{
							$number=$number-$quantity;
							$query5="update stocks SET number=$number where warehouseCode='$warehouseCode' AND ISBN='$ISBN'";
							mysqli_query($db,$query5);

							//insert into shipping order
							$query6="INSERT INTO shippingorder(ISBN,warehouseCode,username,number) values ('$ISBN','$warehouseCode','$username','$number')";
							mysqli_query($db,$query6) or die("error");
							$flag=1;
							

						}
					}

			


			}




			if($flag==1){
				echo "success";
			}
?>