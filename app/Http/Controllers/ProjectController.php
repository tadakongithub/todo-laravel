<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view('create-project');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $project = new Project;
        $project->name = $validated['name'];
        $project->save();

        return redirect()->route('home');
    }
}
