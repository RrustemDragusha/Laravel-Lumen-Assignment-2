<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required',
            'role' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        


              if($request->has('name') && $request->has('email') && $request->has('password') && !$request->has('role')){

            $user_data = $request->only('name', 'email', 'password');
            $user_data['password'] = Hash::make($request->password);
            $user = User::create($user_data);
              }



              if($request->has('name') && $request->has('email') && $request->has('password') && $request->has('role')){
            if ($request->role === 'admin') {

                $this->validate($request, ['address' => 'required', 'phone' => 'required']);
                $admin_data = $request->only('address', 'phone');
                if ($request->has('address') && $request->has('phone')) {
                    $user_data = $request->only('name', 'email', 'password');
                    $user_data['password'] = Hash::make($request->password);
                    $user = User::create($user_data);
                    $user->admin()->create($admin_data);
                    $user = $user->load('admin');
                }
            }
              }


       

        

        return response()->json($user, 200);
    }
}
