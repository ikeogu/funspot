@extends('layouts.app')

@section('content')
  @if(Auth::user()->type=='admin')
    <div class="container" style="padding-top:80px;">
    <div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                   <h4> {{ __('Logout') }}</h4>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
</div>
      <div class="user-mata " >
        <div class="row">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>

                  <strong>{{ $message }}</strong>
              </div>
          @endif
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="card">
            <h4>Follow the link to the <a href="{{route('admin-dash')}}">Admin DashBoard </a><h4>
          </div>
        </div>
        <div class="user-thumbnail">
          <div>
            <img src="/storage/avatars/{{Auth::user()->passport}}" class="img img-responsive img-circle" style="height:200px;width:200px; border-radius:50%"/>
            </div>
            <br>
            <div>
              <form action="/profile" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        
                        <div class="col-md-8">
                            <input id="passport" type="file" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" required>

                                @if ($errors->has('passport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                        </div>
                            <button type="submit" class="btn btn-primary">Change Picture</button>
                      </div>
                  </form>
            </div>
          </div>
          <div class="user-meta-hd">
            <div class="user-meta-dt">
                <p class="u-name"><span>{{Auth::user()->name}}</span>  <span><i class="fa fa-flash"></i></span></p>
                <p class="uname">{{Auth::user()->email}}</p>
                <p class="uname">{{Auth::user()->country}}</p>
              
            </div>
            <div>
              <p class="btn btn-primary sm">Follow</p>
            </div>
            <div class="user-meta-d row show-grid">

                <span class="col-md-3">followers <span>456</span></span>
                <span class="col-md-3">following <span>32</span></span>
                <span class="col-md-3">Videos <span>{{count(Auth::user()->videos)}}</span></span>
                <span class="col-md-3">followers <span>22</span></span>
            </div>
          </div>
        </div>
        <br> <br> <br> <br> <br>
        @if(count(Auth::user()->videos) > 0)
          <div class="user-posts">
            <h2>Commedy Videos</h2>
            <div class="other-rel-posts p-box row show-grid">
                
              @foreach(Auth::user()->videos as $v)
                <div class="other-rel-posts-p col-md-3">
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
          @else
            <div class="rel-post-meta2">
              <h4>You Have No Commedy Channel yet!</h4>
            </div>
          @endif   
      </div>
      <div><svg width="80px"  height="80px" class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.3s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
        
    </div>
  @elseif(Auth::user()->type=='moderator')
  <div class="container" style="padding-top:80px;">
      <div class="user-mata " >
        <div class="row">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>

                  <strong>{{ $message }}</strong>
              </div>
          @endif
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="card">
            
            <h4>Follow the link to the <a href="{{route('admin-dash')}}">Moderator DashBoard </a><h4>
          
          </div>
        </div>
        <div class="user-thumbnail">
                <div>
                <img src="/storage/avatars/{{Auth::user()->passport}}" class="img img-responsive img-circle" style="height:200px;width:200px; border-radius:50%"/>
                </div>
                <br>
                <div>
                  <form action="/profile" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row">
                        
                        <div class="col-md-8">
                            <input id="passport" type="file" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" required>

                                @if ($errors->has('passport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                        </div>
                            <button type="submit" class="btn btn-primary">Change Picture</button>
                      </div>
                  </form>
              </div>
            </div>
            <div class="user-meta-hd">
                <div class="user-meta-dt">
                    <p class="u-name"><span>{{Auth::user()->name}}</span>  <span><i class="fa fa-flash"></i></span></p>
                    <p class="uname">{{Auth::user()->email}}</p>
                    <p class="uname">{{Auth::user()->country}}</p>
                  
                </div>
                <div>
                  <p class="btn btn-primary sm">Follow</p>
                </div>
                <div class="user-meta-d row show-grid">

                    <span class="col-md-3">followers <span>456</span></span>
                    <span class="col-md-3">following <span>32</span></span>
                    <span class="col-md-3">Videos <span>{{count(Auth::user()->videos)}}</span></span>
                    <span class="col-md-3">followers <span>22</span></span>
                </div>
            </div>
        </div>
        <br> <br> <br> <br> <br>
        @if(count(Auth::user()->videos) > 0)
        <div class="user-posts">
            <h2>Commedy Videos</h2>
            <div class="other-rel-posts p-box row show-grid">
              
                @foreach(Auth::user()->videos as $v)
                  <div class="other-rel-posts-p col-md-3">
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
          @else
              <div class="rel-post-meta2">
                <h4>You Have No Commedy Channel yet!</h4>
              </div>
          @endif   
      </div>
      <div><svg width="80px"  height="80px" class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.3s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
        
    </div>
  @else
  <div class="container" style="padding-top:80px;">
  <div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                   <h4> {{ __('Logout') }}</h4>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
</div>
      <div class="user-mata " >
        <div class="row">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>

                  <strong>{{ $message }}</strong>
              </div>
          @endif
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        </div>
        <div class="user-thumbnail">
          <div>
          <img src="/storage/avatars/{{Auth::user()->passport}}" class="img img-responsive img-circle" style="height:200px;width:200px; border-radius:50%"/>
          </div>
          <br>
          <div>
            <form action="/profile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  
                  <div class="col-md-8">
                      <input id="passport" type="file" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" required>

                          @if ($errors->has('passport'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('passport') }}</strong>
                              </span>
                          @endif
                  </div>
                  <button type="submit" class="btn btn-primary">Change Picture</button>
                </div>
            </form>
        </div>
      </div>
            <div class="user-meta-hd">
                <div class="user-meta-dt">
                    <p class="u-name"><span>{{Auth::user()->name}}</span>  <span><i class="fa fa-flash"></i></span></p>
                    <p class="uname">{{Auth::user()->email}}</p>
                    <p class="uname">{{Auth::user()->country}}</p>
                  
                </div>
                <div>
                  <p class="btn btn-primary sm">Follow</p>
                </div>
                <div class="user-meta-d row show-grid">

                    <span class="col-md-3">followers <span>456</span></span>
                    <span class="col-md-3">following <span>32</span></span>
                    <span class="col-md-3">Videos <span>{{count(Auth::user()->videos)}}</span></span>
                    <span class="col-md-3">followers <span>22</span></span>
                </div>
            </div>
        </div>
        <br> <br> <br> <br> <br>
        @if(count(Auth::user()->videos) > 0)
        <div class="user-posts">
            <h2>Commedy Videos</h2>
            <div class="other-rel-posts p-box row show-grid">
              
                @foreach(Auth::user()->videos as $v)
                  <div class="other-rel-posts-p col-md-3">
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
          @else
              <div class="rel-post-meta2">
                <h4>You Have No Commedy Channel yet!</h4>
              </div>
          @endif   
      </div>
      <div><svg width="80px"  height="80px" class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-rolling" style="background: none;"><circle cx="50" cy="50" fill="none" ng-attr-stroke="" ng-attr-stroke-width="" ng-attr-r="" ng-attr-stroke-dasharray="" stroke="#5B99D6" stroke-width="4" r="15" stroke-dasharray="70.68583470577033 25.561944901923447" transform="rotate(300 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;360 50 50" keyTimes="0;1" dur="0.3s" begin="0s" repeatCount="indefinite"></animateTransform></circle></svg></div>
        
    </div>

  @endif

@endsection