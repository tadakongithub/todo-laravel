<?php

namespace App\Models;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ToDo extends Model
{
    use HasFactory;

    public function index()
    {
        $todos = ToDo::orderBy('priority', 'asc')->get();
        return view('home', compact('todos'));
    }

    public function create()
    {
        return view('create-todo');
    }

    public function store(Request $request)
    {

        $validated_todo = $request->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
        ]);

        $todo = new ToDo;
        $todo->name = $validated_todo['name'];
        $todo->detail = $validated_todo['detail'];
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
