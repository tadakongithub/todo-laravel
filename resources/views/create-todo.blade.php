@extends('layouts.app')

@section('title', 'create todo')

@section('content')
    <div class="container pt-3">
        <form action="{{ route('todo.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">todo name</label>
              <input class="form-control" type="text" id="name" name="name" placeholder="apply for laravel job at coalition tech">
            </div>
            <div class="form-group">
              <label for="detail">Detail</label>
              <input class="form-control" type="text" id="detail" name="detail" placeholder="details here">
            </div>
            <div class="form-group">
              <label for="related_project">related project</label>
              <select name="related_project" id="related_project" class="custom-select">
                  @if($projects)
                    @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                  @endif
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Create this ToDo !</button>
          </form>
    </div>
        
@endsection