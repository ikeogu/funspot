@extends('layouts.app')
@section('content')
<div class="admin-pane">
    @include('inc.admin-bar')
            <div class="card table-card">
                <div class="card-header">
                    <h5>Suggestions</h5>
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
                    <div class="table-responsive">
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                   
                                    <th>Email</th>
                                    <th>Title</th>
                                    <th>Suggestion</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($c as $u)
                                    <tr>
                                        <td>{{$u->user->name}}</td>
                                        <td><label class="label label-danger">{{$u->user->email}}</label></td>
                                       
                                        <td>{{$u->title}}</td>
                                        <td>{{$u->body}}</td>
                                        <td>{{$u->created_at->diffForHumans()}}</td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
