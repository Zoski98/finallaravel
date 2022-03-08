<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmed' => 'required|string|min:8|same:password',
        ]);

         if($validator->fails())
        {
            return response()->json([
                'validation_errors'=>$validator->errors(),
            ]);
        }
        else
        {
              $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password =bcrypt($request->input('password'));
            $user->file = $request->input('file');
            $user->save();


        $token = $user->createToken($user->email.'_Token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'username' =>$user->username,
            'token' => $token,
            'token_type' => 'Bearer',
            'status' => 200,
            'message' => 'User added succesfully', ]);
        }

      
    }




    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|max:191',
            'password'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validation_errors'=>$validator->errors(),
            ]);
        }
        else
        {
            $user = User::where('email', $request->email)->first();

            if(! $user || ! Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid Credentials',
                ]);
            }
            else
            {   
                if($user->type == 1)
                {
                    $type = "1";
                    $token = $user->createToken($user->email.'_AdminToken', ['server:admin'])->plainTextToken;

                }
                else
                {
                    $type = "";
                    $token = $user->createToken($user->email.'_Token', [''])->plainTextToken;
                }

                return response()->json([
                    'status'=>200,
                    'username'=>$user->username,
                    'token'=>$token,
                    'message'=>'Logged In Successfully',
                    'type' => $type,
                ]);
            }
        }
    }


    public function logout() {
        auth()->user()->tokens()->delete();

    
        return response()->json(['message' => 'VIVA DRARI'], 200);
    }
    



    // method for user logout and delete token
    // public function logout()
    // {
    //     auth()->user()->current()->delete();

    //     return response()->json( [
    //         'status'=>'200',
    //         'message' => 'You have successfully logged out and the token was successfully deleted',
    //     ]);
    // }
}


