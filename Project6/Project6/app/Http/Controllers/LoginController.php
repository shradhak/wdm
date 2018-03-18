<?php



class LoginController extends \App\Http\Controllers\Controller{

    public function doLogin(Request $request)
    {
       $username = $request->input('username');
       print_r($request);
       echo $username;
    }


}