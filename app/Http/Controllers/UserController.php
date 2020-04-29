<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        if ($request->has('id')) {
            $user = User::find($request->input('id'));
            if ($request->has('password')) {
                $request->merge([
                    'password' => md5($request->input('password')),
                ]);
            }
            $user->update($request->all());
            $response = $user;
        } elseif (!$request->has('id') && !User::where('username', $request->input('username'))->first() &&
            $request->has('username') && $request->has('password') && $request->has('email')) {

            $user            = new User;
            $user->username  = $request->input('username');
            $user->password  = md5($request->input('password'));
            $user->email     = $request->input('email');
            $user->role      = $request->input('role') ?: 'member';
            $user->status    = $request->input('status') ?: 0;
            $user->api_token = str_random(60);
            if ($user->save()) {
                $response = ['message' => ['User Eklendi']];
            } else {
                $response = ['errors' => ['form hatasi']];
            }
        } else {
            $response = ['errors' => ['form hatasi']];
        }
        return $response;
    }

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
    public function getRole(Request $request, $roleId)
    {
        ///api/user?api_token=gokhan
        $role = Role::find($roleId);
        /* $user->password = md5('123456');
        $user->first_name = 'gokhan';
        $user->last_name = 'celik';
        $user->email = 'kafkadeveloper@gmail.com';
        $user->api_token = 'gokhan';
        $user->save();*/
        return response()->json($role);
    }

    public function getLogin(Request $request)
    {

        $user = [];
        if ($request->has('email') && $request->has('password')) {

            $user = User::where("email", $request->input('email'))

                ->where("password", md5($request->input('password')))

                ->first();

            if ($user) {

                $token = Str::random(60);

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
