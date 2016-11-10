<?php
/**
 * Created by PhpStorm.
 * User: SHENJN
 * Email: shenjn0130@gmail.com
 * Date: 2016-11-8
 * Time: 10:25
 */
namespace App\Repositories;
use App\Task;
use App\User;

class TaskRepository{
    /**
     * 获取指定用户的所有task
     * @param user $user
     * @return Collection
     */
    public function forUser(User $user){
        return Task::where('user_id',$user->id)
                     ->orderBy('created_at','asc')
                     ->get();
    }
}