@extends("layouts.app")


@section("content")
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>
    <br>



    @foreach($project->tasks as $task)
        <div class="card">
            <form action="{{ $task->urn() }}" method="post">
                @method("PATCH")
                @csrf
                <div style="display:flex;">
                    <input type="text" class="form-control" name="body" placeholder="Body" value="{{ $task->body }}" style="width: 100%;">
                    <input type="checkbox" name="completed" {{ $task->completed ? "checked" : "" }} onchange="this.form.submit()">
                </div>
            </form>
        </div>
    @endforeach

    <div class="card">
        <h2>Adding task form</h2>
        <form action="{{ $project->urn() }}/tasks" method="post">
            @csrf
            <div class="form-group">
                <label for="body">Body</label>
                <input type="text" class="form-control" name="body" placeholder="Body">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-primary" >Add task</button>
            </div>
        </form>
    </div>
    <br><br><br>


    <form action="{{ $project->urn() }}" method="post">
        @csrf
        @method("PATCH")

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control" placeholder="Notes"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" >Save notes</button>
        </div>

    </form>

    <br><br><br><br>
    <a href="/projects">Back</a>
@endsection