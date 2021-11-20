<form action="{{route('project.store')}}" method="POST">
  @csrf
  <label for="name">project name</label>
  <input type="text" id="name" name="name" placeholder="project A">
  <button type="submit">create this project !</button>
</form>