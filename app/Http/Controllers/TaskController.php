<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use App\Http\Requests\Tasks_Requests\Store_Task_Request;
use App\Http\Requests\Tasks_Requests\Update_Task_Request;
use App\Http\Requests\Tasks_Requests\Update_Task_status_Request;

class TaskController extends Controller
{
    protected $taskservices;
    /**
     * construct to inject Task Services 
     * @param TaskService $taskservices
     */
    public function __construct(TaskService $taskservices)
    {
        $this->middleware('auth');
        $this->taskservices = $taskservices;
    }
    //===========================================================================================================================
    /**
     * method to view all tasks
     * @return /Illuminate\Http\JsonResponse
     * TaskResources to customize the return responses.
     */
    public function index() {  
        $tasks = $this->taskservices->get_all_Tasks();
        return view('tasks.view', compact('tasks'));
    }
    //===========================================================================================================================
    /**
     * method header user to create page
     */
    public function create(){
        return view('tasks.create');
    }
    //===========================================================================================================================
    /**
     * method to store a new task
     * @param   Store_Task_Request $request
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(Store_Task_Request $request)
    {
        $task = $this->taskservices->create_Task($request->validated());
        session()->flash('success', 'create task Successfully');
        return redirect()->route('task.index');
    }
    //===========================================================================================================================
    /**
    * method header user to edit page
    */
    public function edit($task_id){
        $task = Task::find($task_id);
        return view('tasks.update' , compact('task'));
    }
    //===========================================================================================================================
    /**
     * method to update task alraedy exist
     * @param  Update_Task_Request $request
     * @param  Task $task
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(Update_Task_Request $request, Task $task)
    {
        $this->taskservices->update_Task($request->validated(), $task);
        session()->flash('success', 'update task Successfully');
        return redirect()->route('task.index');
    }
    //===========================================================================================================================
        /**
     * method to update task status alraedy exist
     * @param  Update_Task_Request $request
     * @param  Task $task
     * @return /Illuminate\Http\JsonResponse
     */
    public function update_status(Update_Task_status_Request $request, $task_id)
    {
        $this->taskservices->update_Task_status($request->validated(), $task_id);
        session()->flash('success', 'update task status Successfully');
        return redirect()->route('task.index');
    }
    //===========================================================================================================================
        /**
     * method to show task alraedy exist
     * @param  $task_id
     * @return /Illuminate\Http\JsonResponse
     */
    public function show($task_id)
    {
        $task = $this->taskservices->view_task($task_id);
        return view('tasks.show', compact('task'));
    }
    //===========================================================================================================================
    /**
     * method to soft delete task alraedy exist
     * @param  $task_id
     * @return /Illuminate\Http\JsonResponse
     */
    public function destroy($task_id)
    {
        $task = $this->taskservices->delete_task($task_id);
        session()->flash('success', 'delete task Successfully');
        return redirect()->route('task.index');
    }
    // //========================================================================================================================
    /**
     * method to return all soft deleted tasks
     * @return /Illuminate\Http\JsonResponse if have an error
     */
    public function all_trashed_tasks()
    {
        $tasks = $this->taskservices->all_trashed_task();
        return view('tasks.trashed', compact('tasks'));
    }
    //========================================================================================================================
    /**
     * method to restore soft deleted task alraedy exist
     * @param   $task_id
     * @return /Illuminate\Http\JsonResponse
     */
    public function restore($task_id)
    {
        $restore = $this->taskservices->restore_task($task_id);
        session()->flash('success', 'restore task Successfully');
        return redirect()->route('all_trashed_task');
    }
    //========================================================================================================================
    /**
     * method to force delete on task that soft deleted before
     * @param   $task_id
     * @return /Illuminate\Http\JsonResponse
     */
    public function forceDelete($task_id)
    {
        $delete = $this->taskservices->forceDelete_task($task_id);
        session()->flash('success', 'force Delete task Successfully');
        return redirect()->route('all_trashed_task');
    }
    //========================================================================================================================
        /**
     * method to 
     * @return /Illuminate\Http\JsonResponse
     */
    public function Task_Pending()
    {
        $Task_Pending = $this->taskservices->Task_Pending();
        session()->flash('success', 'send pending task Successfully');
        return redirect()->route('home');
    }
    //========================================================================================================================
}
