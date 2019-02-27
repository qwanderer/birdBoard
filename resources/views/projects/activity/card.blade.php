<div class="card" style="padding:10px;">
    <h4>Project activity:</h4>
    @foreach($project->activity as $activity)
        <div style="font-size: 14px;">
            @include("projects.activity.".$activity->description)
            <span style="color:grey;font-size: 12px;">{{ $activity->created_at->diffForHumans() }}</span>
        </div>
    @endforeach
</div>
