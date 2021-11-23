@extends('layouts.app')

@section('title', 'edit')

@section('content')
        <div class="container pt-3">
            <form action="{{route('todo.update', $todo)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">todo name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$todo->name}}">
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <input class="form-control" type="text" id="detail" name="detail" value="{{$todo->detail}}">
                </div>
                <div class="form-group">
                    <label for="related_project">related project</label>
                    <select class="custom-select" name="related_project" id="related_project">
                        @if($projects)
                            @foreach($projects as $project)
                                <option value="{{$project->id}}" {{$todo->project_id === $project->id ? 'selected' : ''}}>{{$project->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                
                <button type="submit" class="btn btn-primary">update !</button>
            </form>
        </div>
@endsection