<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- User ID -->
    <meta name="userid" content="{{ Auth::check() ? Auth::user()->id : '' }}">

    <title>@yield('pageTitle') phpBook</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-nav-lightblue shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/forum') }}">
                    <div><img class="logo" src="/img/phpbook-logo.png"></img></div>
                    <div class="logo-text">phpBook</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#AboutModal">{{ __('About') }}</a>
                        </li>

                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('forum') }}">{{ __('Forum') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <notification v-bind:notifications="notifications"></notification>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            
            @yield('content')
            
        </main>

        <!-- Modal -->
        <div class="modal fade" id="AboutModal" tabindex="-1" role="dialog" aria-labelledby="AboutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                 <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AboutModalLabel">About phpBook</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">

                    <p>Using the Laravel framework, create a working prototype of a push notification system (similar to the one in Facebook).</p> 
                    
                    <p>For instance, the user must receive a notification if other users (e.g., students, teachers) interact (e.g., reply or like) with the user’s post.
                    You may customize any open-source plugins available or write your own.</p>
                    <hr/>
                    <h5 class="modal-title">Demo</h3>
                    <p>You may log in using these credentials or create your own account.</p> 
                        User 1: admin@phpbook.com <br/>
                        User 2: user@phpbook.com
                    <p>Password: 12345678</p>
                    <p>It is recommended you log in cross-browser to both for the demo.</p>  
                    <hr/>
                    <h5 class="modal-title">Features</h3>
                    <li>Add a post</li>
                    <li>Like/Dislike a post* - Receive a notification</li>
                    <li>View a post - Access a post by clicking on the hyperlinked title</li>
                    <li>Update/Delete a post** - Available by clicking on hyperlinked title</li>
                    <li>Comment on post - Available by clicking on hyperlinked title</li>
                    <li>Delete your comment** - Available by clicking on hyperlinked title</li>
                        <small>* You will only be notified if you or someone else likes <b>your own</b> post</small>
                        <br>
                        <small>** You can only update or delete posts or comments of your own</small>
                    <hr/>
                    <h5 class="modal-title">Tools</h3>
                    <li>Frontend: Bootstrap 4, Javascript (jQuery), CSS (SCSS), Vue.js</li>
                    <li>Backend: PHP (Laravel Framework), SQLite (Database)</li>
                    <li>Other: Fontawesome [Icons], Photoshop [Logo], Pusher</li>
                    <li>Sample post texts generated by Lit Ipsum</li>
                    <hr/>
                    <li>Created by LAI, Hong Lan</li>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
