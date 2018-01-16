<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Session;

class TodosController extends Controller
{
    public function index()
    {
    	$todos = Todo::all();
    	return view('todos')->with('todos', $todos);
    }

    public function store(Request $request) 
    {
         $todo = new Todo;
         $todo->todo = $request->todo;
         $todo->save();
         Session::flash('success','Your todo was created.');
         return redirect()->back();
    }

    public function delete($id) 
    {
       $todo = Todo::findOrFail($id);
       $todo->delete();
       Session::flash('success','Your todo was deleted.');
       return redirect()->back();
    }

    public function update($id) 
    {
    	$todo = Todo::findOrFail($id);
    	return view('update')->with('todo', $todo);
    }

    public function save(Request $request, $id) 
    {
        $todo = Todo::findOrFail($id);

        $todo->todo = $request->todo;
        $todo->save();
        Session::flash('success','Your todo was saved.');
        return redirect()->route('todos');
    }

    public function completed($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = 1;
        $todo->save();
        Session::flash('success','Your todo was completed.');
        return redirect()->back();
    }
}
