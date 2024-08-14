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

        if($r->date){
            $filteredDate = $r->date;
        }else{
            $filteredDate = date('Y-m-d');
        }

        $carbonDate = Carbon::createFromDate($filteredDate);

        $data['date_as_string'] = $carbonDate->translatedFormat('d') . ' de ' . ucfirst($carbonDate->translatedFormat('M'));
        $data['date_prev_button'] = $carbonDate->addDay(-1)->format('Y-m');
        $data['date_next_button'] = $carbonDate->addDay(2)->format('Y-m-d');

        // $tasks = Task::whereDate('due_date', date('Y-m-d'))->take(4);
        $data['tasks'] = Task::whereDate('due_date', $filteredDate)->get();

        $data['AuthUser'] = Auth::user();

        $data['tasks_count'] = $data['tasks']->count();
        $data['undone_tasks_count'] = $data['tasks']->where('is_done', false)->count();

        // return view('home', ['tasks' => $tasks, 'AuthUser' => $AuthUser]);
        return view('home', $data);
    }
}
