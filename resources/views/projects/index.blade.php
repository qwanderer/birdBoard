@extends("layouts.app")


@section("content")
    <div style="display: flex; align-items:center;">
        <h1 style="margin-right:auto;">BirdBoard</h1>
        <a href="/projects/create" >Add new project</a>
    </div>

    <ul>
        @forelse($projects as $project)
            <li>
                <a href="{{ $project->urn() }}">{{ $project->title }}</a>
            </li>
        @empty
            <li>No projects</li>
        @endforelse
    </ul>

@endsection