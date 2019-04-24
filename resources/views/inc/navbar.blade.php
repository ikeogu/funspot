<nav class="navbar navbar-expand-md nb">
    <div class="container bd">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="nav-col">
            <div class="navb">
            <div class="form-group">
                <input name="search" type="search" class="form-control" placeholder="Search..">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto bar-right">
               
                <a id="" class="m-icon" onclick="event.preventDefault();"  aria-haspopup="true" aria-expanded="false" v-pre class="nav-link" href="{{ route('login') }}"><i class="fa fa-cloud-upload"></i></a>
                <a id="" class="m-icon" onclick="event.preventDefault();"  aria-haspopup="true" aria-expanded="false" v-pre class="nav-link" href="{{ route('login') }}"><i class="fa fa-bell"></i><sup class="note-count">34</sup></a>
                
                <a id="" class="h-menu m-icon"  aria-haspopup="true" aria-expanded="false" v-pre>
                    <div class="menu-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="dropdn" id="dpd">
                        <ul class='m-list'>
                            <li><a href="/login" class="dropdown-item">Login</a></li>
                            <li><a href="/register" class="dropdown-item">Register</a></li>
                        </ul>
                    </div>
                </a>
            </ul>
            </div>
        </div>
    </div>
    <div class="nb2">
        <ul class="i-list">
            <li><a href="#">Home</a><span class="i-underline"></span></li>
            <li><a href="#">Trending</a><span class="i-underline"></span></li>
            <li><a href="#">Hot</a><span class="i-underline"></span></li>
            <li><a href="#">Live</a><span class="i-underline"></span></li>
            <li><a href="#">Recommended</a><span class="i-underline"></span></li>
        </ul>
    </div>
</nav>
<div class="side-menu-modal" id="mod">
    <div class="side-menu">
        <div>
            <span class="close-bar">X</span>
        </div>
        <ul>
            <li><a href="/login" class=""><i class="fa fa-sign-in"></i> Login</a></li>
            <li><a href="/register" class=""><i class="fa fa-wpforms"></i> Register</a></li>
            <li><a href="/login" class=""><i class="fa fa-bullseye"></i> Playlist</a></li>
            <li><a href="/register" class=""><i class="fa fa-bullseye"></i> Recommended</a></li>
            <li><a href="/login" class=""><i class="fa fa-bullseye"></i> Group Views</a></li>
            <li><a href="/register" class=""><i class="fa fa-bullseye"></i> Hall of Fame</a></li>
        </ul>
    </div>
</div>
