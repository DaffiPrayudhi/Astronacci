@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome, {{ Auth::user()->name }}!</p>
                    <p>Your membership type: {{ Auth::user()->membership_type }}</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('articles') }}" class="btn btn-primary">View Articles</a>
                        <a href="{{ route('videos') }}" class="btn btn-success">View Videos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection