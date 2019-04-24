@extends('layouts.app')
@section('content')
<div class="admin-pane">
    @include('inc.admin-bar')
            <div class="card table-card">
                <div class="card-header">
                    <h5>Flagged Videos</h5>
                </div>
                <div class="card-block p-b-0">
                    <div class="fv-wrap">
                        @foreach ($flag as $f)
                            <div class="flagged-v">
                                <div>
                                    
                                    <div class="post-thumbnail">
                                        <div class="overlay">
                                            <div><svg width="80px"  height="80px" class="loader" xmlns="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.5s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
                                        </div>
                                        <img src="{{$f->fvideos->thumbnail}}" style="width:inherit; height:inherit" />
                                    </div>
                                    <div>
                                    {{$f->fvideos->title}}
                                    </div>
                                    <div>
                                        Flagged By: {{$f->fuser->name}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection