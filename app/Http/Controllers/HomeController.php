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
// dd($r);
        $carbonDate = new Carbon;
        $data['date_as_string'] = "";
        $data['date_prev_button'] = "";
        $data['date_next_button'] = "";

        if($r->date){
            $filteredDate = $r->date;

            $carbonDate = Carbon::createFromDate($filteredDate);

            $data['date_as_string'] = $carbonDate->format('Y-m-d');
            $data['date_prev_button'] = $carbonDate->addDay(-1)->format('Y-m-d');
            $data['date_next_button'] = $carbonDate->addDay(2)->format('Y-m-d');
            // busca baseado na data
            $data['tasks'] = Task::whereDate('due_date', $filteredDate)->get();
        }else{
            $data['tasks'] = Task::simplePaginate(5);
        }
        // dd($data['tasks']);

        // $tasks = Task::whereDate('due_date', date('Y-m-d'))->take(4);

        $data['AuthUser'] = Auth::user();

        $data['tasks_count'] = $data['tasks']->count();
        $data['undone_tasks_count'] = $data['tasks']->where('is_done', false)->count();

        // return view('home', ['tasks' => $tasks, 'AuthUser' => $AuthUser]);
        return view('home', $data);
    }
}
