@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Videos</h2>
    <p>Showing {{ $videos->count() }} videos based on your membership ({{ Auth::user()->membership_type }})</p>
    
    <div class="row">
        @foreach($videos as $video)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p class="card-text">{{ Str::limit($video->content, 100) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection