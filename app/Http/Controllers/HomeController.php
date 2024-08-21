<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $r){
        // dd(Auth::user());
        $user_id = Auth::user()->id;
        $carbonDate = new Carbon;
        $data['date_as_string'] = "";
        $data['date_prev_button'] = "";
        $data['date_next_button'] = "";
        $data['undone_tasks_count'] = 0;
        $data['filter'] = $r->filter;
        $data['tasks_pending'] = "";
        $data['tasks_done'] = "";

        if($r->date){
            $filteredDate = $r->date;
            $taskData = Task::where('user_id', $user_id)->whereDate('due_date', $filteredDate);

            $carbonDate = Carbon::createFromDate($filteredDate);

            $data['date_as_string'] = $carbonDate->format('Y-m-d');
            $data['date_prev_button'] = $carbonDate->addDay(-1)->format('Y-m-d');
            $data['date_next_button'] = $carbonDate->addDay(2)->format('Y-m-d');

            $data['tasks'] = $taskData->Paginate(5);

            if($r->filter == "task_pending"){
                $data['tasks_pending'] = $taskData->where('is_done', 0)->Paginate(5);
            }elseif($r->filter == "task_done"){
                $data['tasks_done'] = $taskData->where('is_done', 1)->Paginate(5);
            }

            $data['undone_tasks_count'] = Task::where('user_id', $user_id)->whereDate('due_date', $filteredDate)->where('is_done', false)->count();
            $data['tasks_count'] = $data['tasks']->total();
        }else{
            $data['filter'] = $r->filter;
            $data['tasks'] = Task::where('user_id', $user_id)->Paginate(5);
            // dd($data['tasks']);
            $data['undone_tasks_count'] = Task::where('user_id', $user_id)->where('is_done', false)->count();
            // dd($data['undone_tasks_count']);
            $data['tasks_count'] = $data['tasks']->total();
            // dd($data['tasks']);

            if($r->filter == "task_pending"){
                $data['tasks_pending'] = Task::where('user_id', $user_id)->where('is_done', 0)->Paginate(5);
            }elseif($r->filter == "task_done"){
                $data['tasks_done'] = Task::where('user_id', $user_id)->where('is_done', 1)->Paginate(5);
            }
        }

        $data['AuthUser'] = Auth::user();

        return view('home', $data);
    }
}
