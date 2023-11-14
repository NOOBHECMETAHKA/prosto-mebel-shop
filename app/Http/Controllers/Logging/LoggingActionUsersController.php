<?php

namespace App\Http\Controllers\Logging;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoggingActionUsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $logs = RedisLogging::getLog();
        $users = User::all();
        return View('logging.index', compact('logs', 'users'));
    }

    public function delete(){
        RedisLogging::clearLog();
        RedisLogging::saveLog("Удаление", "Консоль", Auth::user()->getAuthIdentifier());
        return redirect()->route('users.logs.admin.index');
    }
}
