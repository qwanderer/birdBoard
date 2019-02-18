@extends("layouts.app")


@section("content")
    <h1>Project Creation</h1>
    <form method="post" action="/projects">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" placeholder="Description"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" >Save</button>
            <a href="/projects">Cancel</a>
        </div>
    </form>

@endsection