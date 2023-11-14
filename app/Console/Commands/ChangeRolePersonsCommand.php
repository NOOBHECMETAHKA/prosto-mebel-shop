<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeRolePersonsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'u:ch {user_id} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Меняет роль пользователя с указанным ID';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $role = $this->argument('role');
        if($role != '') {
            $data = [ 'role' =>  $role];
            DB::table(User::$tableName)->where('id', $this->argument('user_id'))->update($data);
            $this->info("Роль успешно изменена!");
        } else{
            $this->info("Требуется роль для пользователя!");
        }
    }
}
