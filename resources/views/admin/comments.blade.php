@extends('layouts.app')
@section('content')
<div class="admin-pane">
    @include('inc.admin-bar')
            <div class="card table-card">
                <div class="card-header">
                    <h5>{{App\Comment::count()}} Comments </h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                            <li><i class="feather icon-trash close-card"></i></li>
                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block p-b-0">
                    <div class="card-body">
                        <div >
                            @foreach($c as $v)
                            <div>
                            
                            <h4>Commentor: {{$v->user->name}}</h4>
                            <h4> Video Commented on: {{$v->video->title}}</h4>
                            <h4> Producer of Video: {{$v->video->producer}}</h4>
                            <h4> Comment made on: {{$v->body}}</h4>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
