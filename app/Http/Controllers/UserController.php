<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function getMyDetail(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }
    public function getUser(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first()->toArray();
        return response()->json($user);
    }
    public function getUsers(Request $request)
    {
        ///api/user?api_token=gokhan
        $users = User::limit(10)->get()->toArray();
        /* $user->password = md5('123456');
         $user->first_name = 'gokhan';
         $user->last_name = 'celik';
         $user->email = 'kafkadeveloper@gmail.com';
         $user->api_token = 'gokhan';
         $user->save();*/
         return response()->json($users);
    }
    public function getRoles(Request $request)
    {
        ///api/user?api_token=gokhan
        $roles = Role::limit(100)->get()->toArray();
        /* $user->password = md5('123456');
         $user->first_name = 'gokhan';
         $user->last_name = 'celik';
         $user->email = 'kafkadeveloper@gmail.com';
         $user->api_token = 'gokhan';
         $user->save();*/
         return response()->json($roles);
    }



    public function getLogin(Request $request)
    {


        $user = [];
        if ($request->has('email') && $request->has('password')) {

            $user = User::where("email", $request->input('email'))

            ->where("password", md5($request->input('password')))

            ->first();


            if ($user) {

                $token           = Str::random(60);

                //$user->api_token = $token;

                //$user->save();

                return response()->json($user, 200);

            } else {

              return response()->json(['errors' => ['unauthorized']], 200);

          }

      } else {

          return response()->json(['errors' => ['unauthorized']], 200);

      }

    }

}
