<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function add(){
        return View('address.add');
    }

    public function store(){
        $data = request()->validate([
            'City' => 'required',
            'Street' => 'required',
            'House' => 'required',
            'Entrance' => 'required',
            'Apartment' => 'required',
        ]);
        $data['user_addresses_id'] = Auth::user()->getAuthIdentifier();

        Address::create($data);
        RedisLogging::saveLog("Добавление", "Адреса", Auth::user()->getAuthIdentifier());
        return redirect()->route('home.profile');
    }

    public function update($id){
        $data = request()->validate([
            'City' => 'required',
            'Street' => 'required',
            'House' => 'required',
            'Entrance' => 'required',
            'Apartment' => 'required',
        ]);
        DB::table(Address::$tableName)->where('id', $id)->update($data);
        RedisLogging::saveLog("Изменение", "Адреса", Auth::user()->getAuthIdentifier());
        return redirect()->route('home.profile');
    }

    public function edit($id){
        $address = Address::all()->where('id', $id)->first();
        return View('address.update', compact('address'));
    }

    public function delete($id){
        DB::table(Address::$tableName)->where('id', $id)->delete();
        RedisLogging::saveLog("Удаление", "Адреса", Auth::user()->getAuthIdentifier());
        return redirect()->route('home.profile');
    }
}
