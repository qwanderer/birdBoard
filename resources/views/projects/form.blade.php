@csrf
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $project->title }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" placeholder="Description">{{ $project->description }}</textarea>
</div>

<div class="form-group">
    <label for="notes">Notes</label>
    <textarea name="notes" class="form-control" placeholder="NOtes">{{ $project->notes }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary" >{{ $submit_text }}</button>
    <a href="{{ $project->urn() }}">Cancel</a>
</div>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
    </ul>
@endif
