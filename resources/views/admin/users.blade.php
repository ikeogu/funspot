@extends('layouts.app')
@section('content')
<div class="admin-pane">
    @include('inc.admin-bar')
            <div class="card table-card">
                <div class="card-header">
                    <h5>Users</h5>
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
                                    <th>Country</th>
                                    
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allu as $u)
                                    <tr>
                                        <td>{{$u->name}}</td>
                                        <td><label class="label label-danger">{{$u->email}}</label></td>
                                        <td>{{$u->country}}</td>
                                        <td>{{$u->status}}</td>
                                        <td>{{$u->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4 " style="background-color: skyblue;">
                                                    <a href="/users/{{$u->id}}/profile" >Details</a>
                                                </div>
                                                <div class="col-4">
                                                    <form action="{{route('block',[$u->id])}}" method="POST">
                                                            @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Block</button>
                                                    </form>
                                                   
                                                </div>
                                                <div class="col-4">
                                                        <form action="{{route('unblock',[$u->id])}}" method="POST">
                                                                @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">Unblock</button>
                                                        </form>
                                                </div>

                                            </div>
                                        </td>
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
