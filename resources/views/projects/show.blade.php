@extends("layouts.app")


@section("content")
    <h1>{{ $project->title }}</h1>
    <div>{{ $project->description }}</div>


    <br><br><br>
    <a href="/projects">Back</a>
@endsection