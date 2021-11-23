@extends('layouts.app')

@section('title', 'home')

@section('head')
@parent
<!-- jquery ui -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
@endsection

      @section('content')

      <div class="container d-flex align-items-center justify-content-around py-5">
        <form action="{{route('home')}}" method="GET" class="d-flex align-items-center">
          <select name="project" class="custom-select">
            @if($projects)
              @foreach($projects as $project)
                <option value="{{$project->id}}" {{$current_project == $project->id ? 'selected' : ''}}>{{$project->name}}</option>
              @endforeach
            @endif
          </select>
          <button type="submit" class="btn btn-primary">filter</button>
        </form>

        <a href="{{route('home')}}">unfilter</a>
      </div>
      

      <div class="container">
        <ul id="sort" class="list-unstyled">
          @if($todos)
            @foreach($todos as $todo)
              <li class="todo-li my-3 bg-light p-2" data-todo-id="{{$todo->id}}" data-todo-priority="{{$todo->priority}}">
                <div class="d-flex flex-wrap">
                  <div class="col-10 align-items-center d-flex">{{$todo->name}}</div>
                  <div class="d-flex align-items-center">
                    <a href="{{route('todo.edit', $todo)}}" class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger delete-todo" data-todo-id="{{$todo->id}}">Delete</button>
                  </div>
                </div>
              </li>
            @endforeach
          @endif
        </ul>
      </div>

      @endsection

      
@section('footer-scripts')
<script>
        // handling deleting todo
        $('.delete-todo').on('click', function(){
          $.ajax({
            type: 'POST',
            url: "{{route('todo.delete')}}",
            data:{
              _method: "DELETE",
              _token: "{{ csrf_token() }}",
              todo_id: $(this).data('todo-id'),
            }
          }).done(function( msg ) {
            let status = msg.status
              if(status == 'success'){
                location.reload()
              }else{
                const warning = `
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    something went wrong. couldn't delete the todo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                `
                $('body').prepend(warning)
              }
          }).fail(function(jqXHR, textStatus, errorThrown) {
            const warning = `
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    something went wrong. couldn't delete the todo.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                `
                $('body').prepend(warning)
          });
        });

        //sort
        let doms = document.querySelectorAll('.todo-li')
        let prioritiesInOriginalOrder = []
        doms.forEach((li) => {
          prioritiesInOriginalOrder.push(li.dataset.todoPriority)
        })

        $('#sort').sortable({
          update: function( event, ui ) {
            let doms = document.querySelectorAll('.todo-li')
            let arrOfIds = []
            let arrOfPriorities = []
            doms.forEach((li) => {
              arrOfIds.push(li.dataset.todoId)
              arrOfPriorities.push(li.dataset.todoPriority)
            })
            

            let ids = JSON.stringify(arrOfIds)
            let priorities = JSON.stringify(prioritiesInOriginalOrder)
            $.ajax({
              type: 'POST',
              url: "{{route('todos.reorder')}}",
              data: {
                _token: "{{ csrf_token() }}",
                ids: ids,
                priorities: priorities
              }
            }).done(function(msg){
              prioritiesInOriginalOrder = arrOfPriorities
            })
          }
        })

        
        </script>
      @endsection
