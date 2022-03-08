<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
   
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('solouser',['only'=> ['index']]);
    // }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $users = User::find($id);
        return response()->json([
            'status' => 200,
            'users' => $users,
        ]);
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Student Deleted Succesfully',
        ]);
    }


    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->update();

        return response()->json([
            'status' => 200,
            'message' => 'User updated succesfully',
        ]);
    }


    public function store(Request $request)
    {
        $validator=FacadesValidator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->getMessageBag()
            ],202);
            
        }
        else {

            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->file = $request->input('file')->store('avatars');
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'User added succesfully',
            ]);
        }
    }
}
