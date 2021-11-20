<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index()
    {
        $todos = ToDo::orderBy('priority', 'asc')->get();
        return view('home', compact('todos'));
    }

    public function create()
    {
        $projects = Project::get();
        return view('create-todo', compact('projects'));
    }

    public function store(Request $request)
    {

        $validated_todo = $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'related_project' => 'nullable|exists:projects,id',
        ]);

        $todo = new ToDo;
        $todo->name = $validated_todo['name'];
        $todo->detail = $validated_todo['detail'];
        $todo->project_id = $validated_todo['related_project'];
        $todo->priority = ToDo::count() + 1;
        $todo->save();

        return redirect()->route('home');
    }

    public function edit($todo)
    {
        $todo = ToDo::find($todo);
        return view('edit-todo', compact('todo'));
    }

    public function updateTodo(Request $request, $todo)
    {

        //validate input
        $validated_todo = $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
        ]);

        //update todo
        $todo = ToDo::find($todo);
        $todo->name = $validated_todo['name'];
        $todo->detail = $validated_todo['detail'];
        $todo->save();

        return redirect()->route('home');
    }

    public function deleteTodo(Request $request)
    {
        $todo = $request->validate([
            'todo_id' => 'exists:to_dos,id',
        ]);
        $todoToDelete = ToDo::find($todo['todo_id']);

        //decrement priority of existing todos whose priprity is bigger than the one we're deleting

        $todos = ToDo::where('priority', '>', $todoToDelete->priority)->get();
        foreach ($todos as $todo) {
            $todo->priority = $todo->priority - 1;
            $todo->save();
        }

        $todoToDelete->delete();

        return response()->json(['status' => 'success']);
    }

    public function updateTodoOrder(Request $request)
    {
        $arrOfPriorities = json_decode($request['data'], true);
        foreach ($arrOfPriorities as $counter => $id) {
            $todo = ToDo::find($id);
            $todo->priority = $counter + 1;
            $todo->save();
        }

        return response()->json(['status' => 'success']);
    }
}
