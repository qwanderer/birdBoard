@extends("layouts.app")

@section("content")
    <h1>Project Edit</h1>
    <form method="post" action="{{ $project->urn() }}">
        @method("PATCH")
        @include("projects.form", [
            'project' => $project,
            'submit_text' => "Update"
        ])
    </form>
@endsection