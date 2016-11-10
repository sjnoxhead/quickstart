<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     *task资源库的实例
     * @var TaskRepository
     */
    protected $tasks;
    /**
     * 构造函数
     * 设置中间件，访问控制
     * 使用依赖注入（DI,IOC）
     */
    public function __construct(TaskRepository $rep_tasks){

        $this->middleware('auth');//使用中间件控制访问
        $this->tasks=$rep_tasks;//获取注入的资源对象
    }

    //index,显示列表
    public function index(Request $request){
        //$tasks=Task::where('user_id',$request->user()->id)->get();

        return view('tasks.index',[
            'tasks'=>$this->tasks->forUser($request->user()),//构造函数使用了依赖注入
        ]);
    }

    /**
     *接收post数据，验证并存储
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name'=>$request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     *删除指定Task
     */
    public function destroy(Request $request,Task $task)
    {
        $this->authorize('task_destroy',$task);
        $task->delete();
        return redirect('/tasks');

    }
}
