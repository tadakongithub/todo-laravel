<?php

namespace App\Models;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ToDo extends Model
{
    use HasFactory;

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
    }
}
