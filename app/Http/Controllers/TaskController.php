<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(){

    }

    public function create(Request $r){
        return view('tasks.create');
    }
    public function edit(Request $r){
        return view('tasks.edit');
    }
    public function delete(Request $r){
        //delete e volta pra home
        return redirect(route('home'));
    }
}
