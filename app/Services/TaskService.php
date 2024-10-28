<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TaskService {
    /**
     * method to view all tasks 
     * @return /Illuminate\Http\JsonResponse if have an error
     */
    public function get_all_Tasks(){
        try {
            $tasks = Cache::remember('all_task', 1800, function ()  {
                return Task::all();
            });
            return $tasks;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to view all tasks: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to store a new task
     * @param   $dtat
     * @return /Illuminate\Http\JsonResponse
     */
    public function create_Task($data) {
        try {

            //create new task
            $task = new Task();
            $task->title = $data['title'];
            $task->description = $data['description'];
            $task->due_date = $data['due_date'];
            $task->status = $data['status'];

            $task->save();

            Cache::forget('all_task');

            return $task;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to update task alraedy exist
     * @param  $data
     * @param  Task $task
     * @return /Illuminate\Http\JsonResponse
     */
    public function update_task($data,Task $task){
        try {  
            $task->title = $data['title'] ?? $task->title;
            $task->description = $data['description'] ?? $task->description;
            $task->due_date = $data['due_date'] ?? $task->due_date;
            $task->status = $data['status'] ?? $task->status;

            $task->save();

            Cache::forget('all_task');

            return $task;
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to update task alraedy exist
     * @param  $data
     * @param  Task $task
     * @return /Illuminate\Http\JsonResponse
     */
    public function update_Task_status($data,$task_id){
        try {  
            $task = Task::find($task_id);
            $task->status = $data['status'] ?? $task->status;

            $task->save();

           Cache::forget('all_task');

            return $task;
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * Method to show task already exist
     * @param  $task_id
     * @return \Illuminate\View\View
     */
    public function view_Task($task_id) {
        try {    
            $task = Cache::remember('task_'.$task_id, 150, function() use ($task_id) {
                return Task::find($task_id);
            });

            return $task;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to view this task: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * Method to soft delete an existing task.
     * @param  $task_id
     * @return \Illuminate\Http\JsonResponse if an error occurs
     */
    public function delete_task($task_id)
    {
        try {  
            $task = Task::find($task_id);
            
            $task->delete();
            
            Cache::forget('all_task');

            return true;
        }  catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete task: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to return all soft delete tasks
     * @return /Illuminate\Http\JsonResponse if have an error
     */
    public function all_trashed_task()
    {
        try {  
            $tasks = Task::onlyTrashed()->get();

            return $tasks;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to all trashed taska: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to restore soft delete task alraedy exist
     * @param   $task_id
     * @return /Illuminate\Http\JsonResponse if have an error
     */
    public function restore_task($task_id)
    {
        try {
            $task = Task::withTrashed()->find($task_id);

            $task->restore();

            return true;

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to restore this task: ' . $e->getMessage());
        }
    }
//========================================================================================================================
    /**
     * method to force delete on task that soft deleted before
     * @param   $task_id
     * @return /Illuminate\Http\JsonResponse if have an error
     */
    public function forceDelete_task($task_id)
    {   
        try {
            $task = Task::onlyTrashed()->find($task_id);
            
            $task->forceDelete();

            return true;
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to forc eDelete this task: ' . $e->getMessage());
        }
    }
//========================================================================================================================

}
