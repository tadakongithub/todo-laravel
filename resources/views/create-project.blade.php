@extends('layouts.app')

@section('title', 'create project')

@section('content')
<div class="container pt-3">
  <form action="{{route('project.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">project name</label>
      <input class="form-control" type="text" id="name" name="name" placeholder="project A">
    </div>
    
    <button class="btn btn-primary" type="submit">create this project !</button>
  </form>
</div>

@endsection