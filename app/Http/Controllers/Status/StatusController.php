<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class StatusController extends Controller
{
    private function statusFilter($data){
        $status = Status::all();

        if(isset($data['name'])){
            $query = 'select * from `'.Status::$tableName.'` where `name` like \'%'.$data['name'].'%\';';
            $status = DB::select($query);
        }

        return $status;
    }
    //---------------------------------------Http work
    public function index(CategoryIndexRequest $request){
        $data = $request->validated();

        $statuses = $this->statusFilter($data);

        return View('statuses.index', compact('statuses'));
    }

    public function destroy($id){
        RedisLogging::saveLog(Status::logicDelete($id) ? "Блокировка" : "Восстановление",
            "Статусы", Auth::user()->getAuthIdentifier());
        return redirect()->route('status.admin.index');
    }

    public function update($id){
        $data = request()->validate(
            [
                'name' => 'min:3|required',
                'description' => ''
            ]);

        if($data['description'] == ''){
            $data['description'] = 'Описание отсуствует';
        }

        DB::table(Status::$tableName)->where('id', $id)->update($data);
        RedisLogging::saveLog("Изменение", "Статусы", Auth::user()->getAuthIdentifier());
        return redirect()->route('status.admin.index');
    }
}
