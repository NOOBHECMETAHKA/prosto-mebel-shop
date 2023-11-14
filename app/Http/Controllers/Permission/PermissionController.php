<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserIndexRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller{

    public function index(UserIndexRequest $request){
        $users = User::all()->filter(function($user){
            return ($user->id != Auth::user()->getAuthIdentifier()) and ($user->role != 'user');
        });
        $roles = User::$roles;
        return View('permission.index', compact('users', 'roles'));
    }

    public function update(){

    }

}
