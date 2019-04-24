@extends('layouts.app')
@section('content')
<div class="admin-pane">
    @include('inc.admin-bar')
            <div class="card table-card">
                <div class="card-header">
                    <h5>Recent Uploads</h5>
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
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Uploaded By</th>
                                    <th>Views</th>
                                    <th>Likes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allv as $v)
                                    <tr>
                                        <td><div id="mThumbnail">
                                                                              
                                        </div></td>
                                        <td>{{$v->title}}</td>
                                        <td>{{$v->producer}}</td>
                                        <td><label class="label label-danger">45k+</label></td>
                                        <td>100M+</td>
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
