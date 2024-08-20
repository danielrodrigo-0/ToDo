<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(){

    }

    public function create(Request $r){
        $categories = Category::all();
        $data['categories'] = $categories;

        return view('tasks.create', $data);
    }
    public function create_action(Request $r){
        $task = $r->only(['title', 'category_id', 'description', 'due_date']);

        $task['user_id'] = 1;
        $dbTask = Task::create($task);
        return redirect(route('home'));
    }
    public function edit(Request $r){
        $id = $r->id;

        $task = Task::find($id);
        if(!$task){
            return redirect(route('home'));
        }
        $categories = Category::all();
        $data['categories'] = $categories;

        $data['task'] = $task;
        return view('tasks.edit', $data);
    }
    public function edit_action(Request $r){
        $edit_task = $r->only(['title', 'due_date', 'category_id', 'description']);

        $edit_task['is_done'] = $r->is_done ? true : false;

        $dbTask = Task::find($r->id);
        if(!$dbTask){
            return redirect(route('home'));
        }
        $dbTask->update($edit_task);
        $dbTask->save();
        return redirect(route('home'));
    }
    public function delete(Request $r){
        //deleta e volta pra home
        $id = $r->id;
        $task = Task::find($id);

        if($task){
            $task->delete();
        }
        return redirect(route('home'));
    }

    public function update(Request $r){
        // dd($r->all());
        $task = Task::findOrFail($r->taskId);
        $task->is_done = $r->status;
        $task->save();
        return ['success' => true];
    }
}
