<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
        ->allowedFilters(['name','email'])
        ->allowedSorts(['name','id'])
        ->paginate();

        $response = [
            'user' => $users
        ];
        return response($response);
    }

    function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|distinct:ignore_case',
            'password' => 'required'
        ]);

        $new_user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $new_user->assignRole($request->role);

        $response = [
            'message' => ['New User Created Successfully!']
        ];
        return response($response);
        
    }

    function show(User $user)
    {
        $response = [
            'user' => $user
        ];
        return response($response);
    }

    function update(User $user,Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        $response = [
            'user' => $user
        ];
        return response($response);
    }

    function destroy(User $user)
    { 
        $user->delete();
        return response('User Deleted!');
    }

}
