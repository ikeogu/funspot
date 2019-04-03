@extends('layouts.app')

@section('content')

		<div class="idx ">
			<div class="cat-title"><span>Latest</span></div>
			<div class="post-cat well row show-grid">
				@foreach($details as $v)
                    <a href="/videos/{{$v->id}}">
					<div class=" col-md-3 thumbnail">
						<div class="post-thumbnail">
							<div class="overlay">
								<div><svg width="80px"  height="80px" class="loader" xmlns="" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.5s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
							</div>
							<img src="{{$v->thumbnail}}" style="width:inherit; height:inherit" />
						</div>
						<div class="post-title">
							<a href="/">{{$v->title}}</a>
						</div>
						<div class="post-author">
							<a href="user/"><i class="fa fa-user"></i>{{$v->producer}} <i class="fa fa-bullseye"></i></a>
						</div>
                        <div class="post-author">
							<a href="user/"><i class="fa fas-calender"></i>{{$v->created_at->diffForHumans()}} <i class="fa fa-bullseye"></i></a>
						</div>
						
					</div>
                    </a>
				@endforeach
			</div>
			
		</div>

		

@endsection