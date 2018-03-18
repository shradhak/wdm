<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
    class Customer_model extends CI_Model
    {
        function __construct()
        {
          // Call the Model constructor
            parent::__construct();
        }

         //get the username & password from table customer
        function get_user($username, $password)
        {
        
            $sql = "select * from customers where password='".md5($password)."' AND username='$username'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }


        //get basketID 
        function get_basket($username)
        {
            $basketID=0;
            $sql="select basketId from shoppingbasket order by basketId desc limit 1";
            $query = $this->db->query($sql);
            $row= $query->row_array();

            $basketID=$row['basketId'];
            $basketID=$basketID+ 1;
            $sql1="INSERT INTO shoppingbasket(basketId,username) values ('$basketID','$username')";
             $query = $this->db->query($sql1);

             return $basketID;
        }


        function getAuthor($search)
        {
            $sql="select ssn from author where name  like '%$search%'";
            $query= $this->db->query($sql);
            
            return $query->num_rows();
        }
        //get book by author
        function getbooks_byAuthor($search)
        {
             
             $stockArray=array();
             $searchData=array();
            $new=array();
             $stockAvailable=0;  
             $flag=0;
             $aflag=0;

             $sql="select ssn from author where name  like '%$search%'";
             $query= $this->db->query($sql);
             
             $data= $query->row_array();
             $ssn=$data['ssn'];

             if(!empty($ssn))
             {
            
                $sql1="select * from writtenby where ssn=$ssn";
                $query1= $this->db->query($sql1);
                //
                $rowCount1= $query1->num_rows();
                $data11= $query1->result_array();
               // echo  $rowCount1;
                foreach($query1->result_array() as $data1)
                {
                    
                    $ISBN=$data1['ISBN'];
                    
                    $sql2="select * from book INNER JOIN stocks ON book.ISBN=stocks.ISBN where book.ISBN=$ISBN";
                    $query2= $this->db->query($sql2);
                    $rowCount= $query->num_rows();

                    foreach ($query2->result_array() as $data) 
                    {
                    

                        $ISBN=$data['ISBN'];
                        $title=$data['title'];
                        $number=$data['number'];
                       // echo "ISBn".$ISBN;
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
                               // echo " s".$stockAvailable;
                                $aflag=0;
                               
                               $new=array(
                                'ISBN' => $ISBN,
                                'title' => $title,
                                'number'=>$stockAvailable
                                );
                                 array_push($searchData,$new);

                            }
                            else
                            {
                                 array_push($stockArray, $ISBN);
                                $aflag=0;
                                $new=array(
                                'ISBN' => $ISBN,
                                'title' => $title,
                                'number'=>$number
                                );
                                array_push($searchData,$new);

                            }
                        }

                
                       
                    }
                     if($aflag == 1 && !empty($number))
                         {
                              $new=array(
                              'ISBN' => $ISBN,
                              'title' => $title,
                              'number'=>$number
                            );
                              $aflag=0;
                              array_push($searchData,$new);

                        }
                            
                }

              
                     
            }
             
            // echo  "hi".count($searchData).'<br>';
            return $searchData;
        }


        //get book by title
        function getbooks_byTitle($search)
        {
            $stockArray=array();
            $searchData=array();
            $new=array();
            
            $aflag=0;
            $stockAvailable=0;
            $sql="select * from book where title  like '%$search%'";
            $query= $this->db->query($sql);
            $number= $query->num_rows();
            foreach ($query->result_array() as $row) 
            {
                $ISBN=$row['ISBN'];
                 $title=$row['title'];
               // echo $ISBN;
                $sql2="select * from book INNER JOIN stocks ON book.ISBN=stocks.ISBN where book.ISBN=$ISBN";
                $query2=$this->db->query($sql2);
                foreach ($query2->result_array() as $row2) 
                {
                        $ISBN=$row2['ISBN'];
                          //echo $ISBN;
                        $title=$row2['title'];
                        $number=$row2['number'];
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
                               // echo " s".$stockAvailable;
                                $aflag=0;
                               
                               $new=array(
                                'ISBN' => $ISBN,
                                'title' => $title,
                                'number'=>$stockAvailable
                                );
                                 array_push($searchData,$new);

                            }
                            else
                            {
                                 array_push($stockArray, $ISBN);
                                $aflag=0;
                                $new=array(
                                'ISBN' => $ISBN,
                                'title' => $title,
                                'number'=>$number
                                );
                                array_push($searchData,$new);

                            }
                        }

                       
                    
                }
                 if($aflag == 1 && !empty($number))
                         {
                              $new=array(
                              'ISBN' => $ISBN,
                              'title' => $title,
                              'number'=>$number
                            );
                              $aflag=0;
                              array_push($searchData,$new);

                        }
            }

        return $searchData;

        }



        //add to cart
        function get_addCart($ISBN,$quantity)
        {
            $basketID=$this->session->userdata('basketID');
            //get number of books already in cart
            $count=0;
            $sql="select number from contains where ISBN='$ISBN' AND basketId='$basketID'";
            $query= $this->db->query($sql);
            $number= $query->num_rows();
            foreach ($query->result_array() as $row) 
            {
                $count=$row["number"];
    
            }
            if($number>0)
            {
                $count=$count+$quantity;    
                $sql1="update contains SET number=$count where ISBN='$ISBN' AND basketId='$basketID'";
                $this->db->query($sql1);
            }
            else
            {
                $sql2="INSERT INTO contains(ISBN,basketId,number) VALUES ($ISBN,$basketID,$quantity)";
                $this->db->query($sql2);

            }

            return $basketID;
        }



        function post_page3Data()
        {
            //get isbn and number of books addeed to cart from contains table
                $total=0;
                $bookData=array();
                $new=array();
                $basketID=$this->session->userdata('basketID');
                $sql="select * from contains where basketId='$basketID'";
                $query= $this->db->query($sql);
                foreach ($query->result_array() as $row) 
                {
                    $ISBN=$row["isbn"];
                    $number=$row["number"];
                    $sql2="select * from book where ISBN='$ISBN'";
                    $query2= $this->db->query($sql2);
                    foreach ($query2->result_array() as $row2) 
                    {
                        $price=$row2["price"]; 
                        $title=$row2['title'];
                        $total+=$number*$price;  
                         $new=array(
                                'ISBN' => $ISBN,
                                'title' => $title,
                                'number'=>$number,
                                'price'=>$price,
                                'total'=>0
                                );
                                 array_push($bookData,$new);  

                    }
                     $new=array(
                                'ISBN' =>0,
                                'title' =>0,
                                'number'=>0,
                                'price'=>0,
                                'total'=>$total
                                );

                     array_push($bookData,$new);  

   
                }
                return $bookData;
        }



        function get_buyBook()
        {
            $flag=0;
            $basketID=$this->session->userdata('basketID');
             $username=$this->session->userdata('username');
            //get number of books already in cart

            $sql="select * from contains where basketId='$basketID'";
            $query= $this->db->query($sql);
            foreach ($query->result_array() as $row) 
            {
                $ISBN=$row["isbn"];
                $quantity=$row["number"];


                    //get warehousecode and number of books available in that warehouse from stock table

                    $sql2="select * from stocks where ISBN='$ISBN'";
                    $query2= $this->db->query($sql2);
                    foreach ($query2->result_array() as $row2)
                    {
                        $warehouseCode=$row2["warehouseCode"];
                        $number=$row2["number"];

                        if(!empty($number) && $quantity>$number)
                        {
                            $quantity=$quantity-$number;
                            //update stocks
                            $sql3="update stocks SET number=0 where warehouseCode='$warehouseCode' AND ISBN='$ISBN'";
                            $this->db->query($sql3);

                            //insert into shipping order
                            $sql4="INSERT INTO shippingorder(ISBN,warehouseCode,username,number) values ('$ISBN','$warehouseCode','$username','$quantity')";
                            $this->db->query($sql4);
                            $flag=1;
                        }

                        elseif (!empty($number) && $number>=$quantity) 
                        {
                            $number=$number-$quantity;
                            $sql5="update stocks SET number=$number where warehouseCode='$warehouseCode' AND ISBN='$ISBN'";
                            $this->db->query($sql5);

                            //insert into shipping order
                            $sql6="INSERT INTO shippingorder(ISBN,warehouseCode,username,number) values ('$ISBN','$warehouseCode','$username','$quantity')";
                            $this->db->query($sql6);
                           $flag=1;
                        }
                            

                    } 

            }
            if($flag==1)
            {
                return $flag;
            }



        }


        //new user
        function register_newuser($username,$password,$address,$email,$phone)
        {
                 $sql='insert into Customers values("'.$username.'","'. md5($password) . '","'.$address.'","'.$phone.'","'.$email.'")';
                 $query=$this->db->query($sql);
                 
        }

    }//class ends
    
?>