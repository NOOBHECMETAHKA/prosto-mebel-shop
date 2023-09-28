<?php

namespace App\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;
use function PHPUnit\Framework\isNull;

class StatusController extends Controller
{
    private function statusFilter($data){
        $status = Status::all();

        if(isset($data['id']))
            $status = $status->where('id', $data['id']);
        if(isset($data['name']))
            $status = $status->where('name', 'LIKE', "%{$data['name']}%");

        return $status;
    }
    //---------------------------------------Http work
    public function index(CategoryIndexRequest $request){
        $data = $request->validated();

        $statuses = $this->statusFilter($data);

        return View('statuses.index', compact('statuses'));
    }

    public function destroy($id){
        DB::table(Status::$tableName)->where('id', $id)->delete();
        return redirect()->route('statuses.admin.index');
    }

    public function store(){
        $data = request()->validate(
            [
                'name' => 'min:3|required|unique:categories',
                'description' => ''
            ]);
        Status::create($data);
        return redirect()->route('statuses.admin.index');
    }

    public function update($id){
        $data = request()->validate(
            [
                'name' => 'min:3|required',
                'description' => ''
            ]);

        if(isNull($data['description']))
            $data['description'] = '';

        DB::table(Status::$tableName)->where('id', $id)->update($data);

        return redirect()->route('statuses.admin.index');
    }
}
