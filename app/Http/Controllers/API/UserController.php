<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ReturnData;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public $successStatus = 200;
    /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

      /**ADMIN Register */
      public function adminregister()
      {

          $input['name']="Admin";
          $input['email']='Admin@gmail.com';
          $input['password']='Admin@123';
          $input['userType']='Admin';
          $input['address'] = "default";

           $input['password'] = bcrypt($input['password']);
          $input['status']=0;
          $user = User::create($input);

          return ReturnData::returnData(true,$user);

      }
    /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
    public function register(Request $request)
    {
             $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required|email|unique:users,email',
                        'address'=>'required',
                        'company'=>'required'


                    ]);
            if ($validator->fails()) {
                        // return response()->json(['error'=>$validator->errors()], 401);
                        return ReturnData::returnData(false,$validator->errors()->first());
            }

            $input = $request->all();

            /**TODO: If u want to add user password remove the comment form here  */
            /** $password = $input['password'] */

            /**Default Password*/
            $password = 'hDD*rhCa3B]+@8]W';

            $input['password'] = bcrypt($password);


            $user = User::create($input);

            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;
            $success['id']  = $user->id;
            $success['address'] = $user->address;
            $success['email']=$user->email;

            return ReturnData::returnData(true,$success);
            // return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
         * details api
         *
         * @return \Illuminate\Http\Response
         */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function getUsers()
    {
        $data = User::where('userType','user')->get();
        return ReturnData::returnData(true,$data);
    }
}
