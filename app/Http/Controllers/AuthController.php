<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
   public function store(Request $request)
   {
       $this->validate($request,[
           'name'=>'required',
           'email'=>'required',
           'password'=>'required'
       ]);
       $name=$request->input('name');
       $email=$request->input('email');
       $password=$request->input('password');

       $user= new User([
         'name'=>$name,
         'email'=>$email,
         'password'=>bcrypt($password)
       ]);

       if($user->save())
       {
           $user->signin=[
               'href'=>'api/v1/user/signin',
               'method'=>'POST',
               'params'=>'email,password'
           ];

           $response=[
             'msg'=>'User Berhasil Dibuat',
             'user'=>$user
           ];

           return response()->json($response,201);
       }

       $response=[
         'msg'=>'An Error Occured'
       ];
       return response()->json($response,404);



   }

   public function signin(Request $request)
   {

       $this->validate($request,[
          'email'=>'required',
           'password'=>'required'
       ]);
       $email=$request->input('email');
       $password=$request->input('password');

       $data=[
           'email'=>$email,
           'password'=>$password
       ];

       $response=[
         'payload'=>[

         ],
           'error'=>[
               'code'=>'1',
               'message'=>'Password Salah'
           ],
       ];

       return response()->json($data,200);

   }
}
