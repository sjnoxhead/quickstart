<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //设置name属性为批量赋值
    protected $fillable=['name'];

    /**
     *获取拥有此task的用户
     */

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    protected $policies=[
        'App\Task'=>'App\Policies\TaskPolicy',
    ];
}
