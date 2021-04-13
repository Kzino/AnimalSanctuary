@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <nav class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{Route::currentRouteName() == 'home' ? 'active' : ''}}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('request') }}" class="nav-link {{Route::currentRouteName() == 'request' ? 'active' : ''}}">
                            Request
                        </a>
                    </li>
                </nav>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div id="api_alert"></div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="h2">@yield('title')</div>
                @yield('extra-header')
            </div>
            @yield('public-content')
        </main>
    </div>
</div>
@endsection
