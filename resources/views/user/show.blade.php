@extends('layouts.app')
@section('content')

<div class="admin-pane">
    @include('inc.admin-bar')
    <div class="container-fluid card">
            <div class="card-header">
                    <h5>{{$u->name}} Profile</h5>
                            
            </div>
        <div class=" card-body">
            
            <div class=" card-block ">
                    <img src="/storage/avatar/{{$u->passport}}" />
                    
                </div>
                <div class="">
                    <div class="card-block" >
                        <h3 class="u-name" style="color:black"><span>{{$u->name}}</span>  <span><i class="fa fa-flash"></i></span></h3><br>
                        <h3 class="uname" style="color:black">{{$u->email}}</h3>
                        
                    </div>
                    <div class="user-meta-d row show-grid">
                        <span class="col-md-3">followers <span>456</span></span>
                        <span class="col-md-3">following <span>32</span></span>
                        <span class="col-md-3">posts <span>52</span></span>
                        <span class="col-md-3">followers <span>22</span></span>
                    </div>
                </div>
            </div>
            <div class=" card-block">
                <h2>Commedy Videos</h2>
                <div class="other-rel-posts p-box row show-grid">
                    @foreach($u->videos as $v)
                        <div class="other-rel-posts-p col-md-4" style="padding:20px;">
                            <div class="rel-post-thumbnail2">
                                <div class="overlay">
                                        <div><svg width="80px"  height="80px" class="loader" xmlns="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.5s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
                                </div>
                                    <img src="{{$v->thumbnail}}" style="width:inherit; height:inherit" />
                            </div>
                            <div class="rel-post-data2">
                                <div class="rel-post-title2">
                                    <a href="#">{{$v->title}}</a>
                                </div>
                                <div class="rel-post-meta2">
        
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
       
        </div>
        <div class="card-footer"> <h4><strong>Created Profile at {{$u->created_at->diffForHumans()}}</strong> </h4></div>  
    </div>    
</div>

@endsection