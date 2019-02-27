@extends("layouts.app")


@section("content")

    <div class="row">
        <div class="col-md-9" >
            <div class="card" style="padding:10px;">
                <h1 >{{ $project->title }} <a class="btn btn-sm btn-info" href="{{ $project->urn()."/edit" }}">Edit project</a> </h1>
                {{ $project->description }}
                <br>
                @foreach($project->tasks as $task)
                    <form action="{{ $task->urn() }}" method="post">
                        @method("PATCH")
                        @csrf
                        <div>
                            <input type="text" name="body" placeholder="Body" value="{{ $task->body }}" >
                            <input type="checkbox" name="completed" {{ $task->completed ? "checked" : "" }} onchange="this.form.submit()">
                        </div>
                    </form>
                @endforeach

                <form action="{{ $project->urn() }}/tasks" method="post" style="margin-top:20px;">
                    @csrf
                    <div class="row">
                        <div class="col-md-10" style="padding-right:0;">
                            <input type="text" class="form-control" name="body" placeholder="Add a task...">
                        </div>
                        <div class="col-md-2" style="padding:0;">
                            <button type="submit" class="btn btn-success" >Add task</button>
                        </div>
                    </div>
                </form>

                <form action="{{ $project->urn() }}" method="post" style="margin-top:40px;">
                    @csrf
                    @method("PATCH")

                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control" placeholder="Notes">{{ $project->notes }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" >Save notes</button>
                    </div>

                </form>
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <br><br>
                <a href="/projects">Back</a>
            </div>
        </div>
        <div class="col-md-3" >
            @include("projects.activity.card")
        </div>
    </div>

@endsection