<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Page1Controller extends Controller
{
    public function doLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if(empty($username) && empty($password))
        {
            $msg="invalid";
                return view('Page1')->with('emptyUser',$msg);
        }
        else
        {

            $users = DB::select('select username from customers where username = ? and password=?', [$username,md5($password)]);

            if(!empty($users))
            {
                foreach ($users as $user) 
                {
                  $in_user=$user->username;

                    if($in_user == $username)
                    {
                        session(['active_user' => $username]);
                        return view('Page2');
                    }
                    else 
                    {
                        return view('Page1');
                    }
                }
            }
            else
            {
                $msg="invalid";
                return view('Page1')->with('invalid',$msg);
            }
        }

    }

    public function doLogout()
    {
        auth()->logout();
        Session::flush();
        return redirect('/');

    }


    public function doRegister()
    {
        return view('page4');
    }

    public function userRegister(Request $request){

        $username = $request->input('username');
        $password = $request->input('password');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $userExist = DB::select('select username from customers where username=?',[$username]);
        print_r($userExist);

        if(!$userExist){
            echo "In Insert";
            DB::insert('Insert into customers values(?,?,?,?,?)',[$username, md5($password), $address, $phone, $email]);
            return view('Page1');
        }else{

        echo "User Already Exists";
    }

    }


    public function doSearch(Request $request){

    if($request->input('author')){

        $searchStr = $request->input('search');

        if(!trim($searchStr)){

           // $qryResult = DB::select("select b.isbn as isbn, b.title as title, b.year as year, b.price as price, b.publisher as publisher,(select sum(s.number) from stocks s where s.isbn = b.isbn) as count from author a,writtenby w, book b where a.ssn = w.ssn	and w.isbn = b.isbn");

            $msg="nosearch";
            return view('Page2')->with('nosearch',$msg);

        } else{

            $qryResult = DB::select("select b.isbn as isbn, b.title as title, b.year as year, b.price as price, b.publisher as publisher,(select sum(s.number) from stocks s where s.isbn = b.isbn) as count from author a,writtenby w, book b where a.ssn = w.ssn 	and lower(a.name) like '%$searchStr%' and w.isbn = b.isbn");
            if(!empty($qryResult))
            {
                return view('Page2')->with('qryResult',$qryResult);

            }
            else
            {
                        $msg="nosearch";
                        return view('Page2')->with('nosearch',$msg);
            }
			
		  

        }



    }
        elseif ($request->input('title')){

            $searchStr=$request->input('search');
			$bk=array();
			$ISBN=0;
			$title=0;

            

            $searchStr = $request->input('search');

            if(!trim($searchStr)){

               //// $qryResult = DB::select("select b.isbn, b.title, b.year, b.price, b.publisher, sum(s.number) as count from book b, stocks s where  s.number > 0 and b.isbn = s.isbn group by b.isbn");

               // return view('Page2')->with('qryResult',$qryResult);
                  $msg="nosearch";
            return view('Page2')->with('nosearch',$msg);

            } else{

                $qryResult = DB::select("select b.isbn, b.title, b.year, b.price, b.publisher, sum(s.number) as count from book b, stocks s where lower(b.title) like '%$searchStr%' and s.number > 0 and b.isbn = s.isbn group by b.isbn");
                if(!empty($qryResult))
                {
                    return view('Page2')->with('qryResult',$qryResult);
                }
                else
                {
                        $msg="nosearch";
                        return view('Page2')->with('nosearch',$msg);
                }

            }

            

        }
    }


    public function addCart(Request $request)
    {
        $isbn = $request->input('bookinfo');
        $sum = 0;
        if(!session('bucket')){
            session(['bucket'=>array($isbn=>1)]);

        }
        else{
            $items = session('bucket');
            $flag = 1;
            foreach ($items as $key => $value){
                if($key == $isbn){
                    $items[$key]=$value+1;
                    $flag=0;
                }
            }
            if($flag==1){
                $items[$isbn]=1;
            }

            session(['bucket'=>$items]);
        }
        return view('Page2');
    }


    public function shopBasket(){

        if(session('bucket')){

            $items=session('bucket');
            $msg = "<div class='row' id='itemDetails'>
                        <div class='col-sm-10'>
           
                            <div class='panel  panel-primary' id='thide'>
                            <table class='table table-bordered table-responsive table-hover'>
                            <div class='panel-heading'><h3>Shopping Cart</h3></div>

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
                                </tr>";
            $sum = 0.0;
            foreach ($items as $key=>$value){

                $isbn = $key;
                $bookCnt = $value;


                $query = DB::select('select title, price from book where isbn=?',[$isbn]);

                foreach ($query as $res){
                    $title = $res->title;
                    $price = $res->price;
                    $total_price = $bookCnt * $price;

                    $msg.="<tr><td>".$key."</td><td>".$title."</td><td>".$bookCnt."</td><td>".$total_price."</td></tr>";
                    $sum = $sum + $total_price;
                }


            }
            $token = csrf_token();
            $msg.="<tr>
                                 <td colspan='3' style='text-align: center;'>
                                     <h4><strong>Total Amount :</strong></h4>       
                                </td>
                               <td>
                                    <h5><strong>".$sum."</strong></h5>
                                </td>
                            </tr>


            
			             </table>
                         </div


                         <br>
                         <br>
                          <div class='col-sm-4 col-sm-offset-5'>
			             <form action='buy' method='POST'>
			             <input type='submit' value='Buy'class='btn btn-success btn-lg '>
			             <input type='hidden' name='_token' value=".$token.">
			             </form>
                         </
                         </div>
                         </div>
                         ";
            return view('Page3')->with('msg',$msg);



        } else{
            return view('Page3')->with('msg',"<h4>Shopping Cart Empty</h4><br><a href='/Page2'>Continue Shopping</a>");
        }


    }

    public function buy(){

    $username = session('active_user');

    DB::insert('Insert into shoppingbasket(username) values (?)',[$username]);

    $fetchQry = DB::select('select basketid from shoppingbasket where username=? order by basketid desc limit 1',[$username]);

    $bId = 0;
    foreach ($fetchQry as $res) {
        # code...
        $bId = $res->basketid;
    }

    $data = session('bucket');

    foreach ($data as $key => $value) {
        $isbn = $key;
        $qty = $value;

        DB::insert('Insert into contains values(?,?,?)',[$isbn,$bId,$qty]);


        $fetchQry1 = DB::select('select warehousecode, number from stocks where isbn=? and number>=? order by 2 desc limit 1',[$isbn,$qty]);


        foreach ($fetchQry1 as $res2) {
            # code...
            $warehousecode = $res2->warehousecode;
        }

        DB::insert('insert into shippingorder values (?,?,?,?)',[$isbn,$warehousecode,$username,$qty]);

        DB::update('update stocks set number = number - ? where warehousecode=? and isbn=?',[$qty,$warehousecode,$isbn]);

    }
        Session::flush();
        return view('Page3')->with('msg',"<h4>Purchase Successfull</h4><br><a href='/Page2'>Continue Shopping</a>");

    }


}
