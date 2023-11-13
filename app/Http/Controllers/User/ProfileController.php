<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        $user = Auth::user();
        $addresses = Address::all()->where('user_addresses_id', $user->getAuthIdentifier());
        return View('storeSystem.profile', compact('user', 'addresses'));
    }

    public function edit(){
        $data = \request()->validate([
            'name' => 'required|min:3|max:100'
        ]);
        DB::table(User::$tableName)->where('id', Auth::user()->getAuthIdentifier())->update($data);
        return redirect()->route('home.profile');
    }
}
