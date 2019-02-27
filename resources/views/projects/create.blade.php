@extends("layouts.app")


@section("content")
    <h1>Project Creation</h1>
    <form method="post" action="/projects">
        @include("projects.form", [
            'project' => new App\Project(),
            'submit_text' => "Create"
        ])
    </form>
@endsection