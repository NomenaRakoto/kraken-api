<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController as APIController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\LoginRequest;
   
class AuthController extends APIController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Login api
     * @method login
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('kraken')->accessToken; 
            $success['name'] =  $user->name;
            return $this->sendResponse($success, __("messages.login_success"));
        } 
        else{ 
            return $this->sendError(__("messages.unauthorised"), ['error'=>__("messages.login_error")], 401);
        } 
    }
}