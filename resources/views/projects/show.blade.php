@extends("layouts.app")


@section("content")
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>
    <br>

    @foreach($project->tasks as $task)
        <div class="card">{{ $task->body }}</div>
    @endforeach

    <br><br><br>
    <a href="/projects">Back</a>
@endsection